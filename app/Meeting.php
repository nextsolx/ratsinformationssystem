<?php

namespace App;

use Illuminate\Support\Arr;

class Meeting extends Model
{
    public static $basicScope = ['location', 'agenda', 'files', 'organizations', 'organizations.people'];

    protected $fillable = [
        'id',
        'name',
        'meeting_state',
        'start',
        'end',
    ];

    protected $dates = [
        'start',
        'end'
    ];

    public static function initialize(array $data)
    {
        $meeting = parent::initialize($data);

        if ($location = Arr::get($data, 'location')) {
            $location = Location::initialize($data['location']);
            $location->meeting()->associate($meeting);
            $location->save();
        }

        if ($organizations = Arr::get($data, 'organization')) {
            foreach ($organizations as $organization) {
                $meeting->organizations()->syncWithoutDetaching(self::extractIdFromUrl($organization));
            }
        }

        if ($file = Arr::get($data, 'invitation')) {
            $meeting->files()->syncWithoutDetaching(self::extractIdFromUrl($file['id']));
            $meeting->files()->updateExistingPivot(self::extractIdFromUrl($file['id']), ['type' => 'invitation']);
        }

        if ($file = Arr::get($data, 'resultsProtocol')) {
            $meeting->files()->syncWithoutDetaching(self::extractIdFromUrl($file['id']));
            $meeting->files()->updateExistingPivot(self::extractIdFromUrl($file['id']), ['type' => 'resultsProtocol']);
        }

        if ($file = Arr::get($data, 'verbatimProtocol')) {
            $meeting->files()->syncWithoutDetaching(self::extractIdFromUrl($file['id']));
            $meeting->files()->updateExistingPivot(self::extractIdFromUrl($file['id']), ['type' => 'verbatimProtocol']);
        }

        if ($files = Arr::get($data, 'auxiliaryFile')) {
            foreach ($files as $file) {
                $meeting->files()->syncWithoutDetaching(self::extractIdFromUrl($file['id']));
                $meeting->files()->updateExistingPivot(self::extractIdFromUrl($file['id']), ['type' => 'auxiliaryFile']);
            }
        }

        return $meeting;
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function organization()
    {
        return $this->organizations()->first();
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }

    public function people()
    {
        return $this->organizations->map(function($organization) {
            return $organization->people;
        })->flatten(1);
    }

    public function peopleCount()
    {
        return $this->people()->count();
    }


    public function agenda()
    {
        return $this->hasMany(Agendum::class);
    }

    public function agendaCount()
    {
        return $this->agenda->count();
    }

    public function files()
    {
        return $this->belongsToMany(File::class);
    }

    public function fileCount()
    {
        return $this->files->count();
    }
}
