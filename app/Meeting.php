<?php

namespace App;

use App\OParl\OParlApiManager;
use Illuminate\Support\Arr;

class Meeting extends Model
{
    protected $dates = [
        'start',
        'end',
    ];

    protected $fillable = [
        'id',
        'name',
        'meeting_state',
        'start',
        'end',
    ];

    public static function initialize(array $data)
    {
        $meeting = parent::initialize($data);

        if ($location = Arr::get($data, 'location')) {
            $location = Location::initialize($data['location']);
            $location->meeting()->associate($meeting);
            $location->save();
        }

        return $meeting;
    }

    public function location()
    {
        return $this->hasOne(Location::class);

        //Todo: Verify
        return Arr::has($this->data, 'location') ? new Location($this->location) : null;
    }

    //Todo: Verify
    public function organization()
    {
        if ($organizationUrl = collect($this->organization)->first()) {
            return OParlApiManager::organization($this->extractIdFromUrl($organizationUrl));
        }

        return null;
    }

    //Todo: Verify
    public function organizations()
    {
        $organizationIds = collect($this->organization)->map(function ($organizationUrl) {
            return $this->extractIdFromUrl($organizationUrl);
        });

        return OParlApiManager::organizations($organizationIds);
    }

    //Todo: Verify
    public function files()
    {
        $files = collect($this->auxiliaryFile)->map(function ($auxiliaryFile) {
            return new File($auxiliaryFile);
        });

        if ($this->vebatimProtocol) {
            $files->push(new File($this->invitation));
        }
        if ($this->vebatimProtocol) {
            $files->push(new File($this->vebatimProtocol));
        }

        return $files;
    }

    //Todo: Verify
    public function agenda()
    {
        return collect($this->agendaItem)->map(function ($agendaItem) {
            return new Agendum($agendaItem);
        });
    }

    //Todo: Verify
    public function agendaCount()
    {
        return $this->agendaItem ? count($this->agendaItem) : 0;
    }

    //Todo: Verify
    public function people()
    {
        return $this->organizations()->map(function($organization) {
            return collect($organization->membership)->map(function($membershipUrl) {
                return OParlApiManager::personFromMembership($this->extractIdFromUrl($membershipUrl));
            });
        })->flatten(1);
    }

    //Todo: Verify
    public function peopleCount()
    {
        return $this->organizations()->map(function($organization) {
            return $organization->peopleCount();
        })->sum();
    }

    //Todo: Verify
    public function fileCount()
    {
        return (int)((bool)$this->invitation) +
            (int)((bool)$this->resultsProtocol) +
            (int)((bool)$this->verbatimProtocol) +
            ($this->auxiliaryFile ? count($this->auxiliaryFile) : 0);
    }
}
