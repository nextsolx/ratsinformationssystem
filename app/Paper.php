<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class Paper extends Model
{
    public static $basicScope = [
        'locations', 'files', 'agendaItems',
        'consultations', 'consultations.meeting', 'consultations.agendum',
        'meetings', 'meetings.location', 'meetings.agenda', 'meetings.files', 'meetings.organizations', 'meetings.organizations.people',
    ];

    const AVAILABLE_SCOPES = ['new','updated','finished','sort'];

    protected $dates = [
        'date',
        'modified'
    ];

    protected $fillable = [
        'id',
        'name',
        'reference',
        'paperType',
        'date',
        'modified'
    ];

    public static function initialize(array $data)
    {
        $paper = parent::initialize($data);

        if ($locations = Arr::get($data, 'location')) {
            foreach ($locations as $location) {
                $location = Location::initialize($location);
                $paper->locations()->syncWithoutDetaching($location);
            }
        }

        if ($file = Arr::get($data, 'mainFile')) {
            $paper->files()->attach(
                self::extractIdFromUrl($file['id']),
                ['type' => 'mainFile']
            );
        }

        if ($files = Arr::get($data, 'auxiliaryFile')) {
            foreach ($files as $file) {
                $paper->files()->attach(
                    self::extractIdFromUrl($file['id']),
                    ['type' => 'auxiliaryFile']
                );
            }
        }

        return $paper;
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class, 'consultations');
    }

    public function agendaItems()
    {
        return $this->belongsToMany(Agendum::class, 'consultations')->withPivot('authoritative');
    }

    public function mainFile()
    {
        return $this->belongsToMany(File::class)->wherePivot('type', 'mainFile');
    }

    public function files()
    {
        return $this->belongsToMany(File::class);
    }

    public function scopeSort(Builder $query)
    {
        return $query->whereNotNull('date')->orderBy('date', 'DESC');
    }

    public function scopeNew(Builder $query)
    {
        return $query->whereNotNull('date')->where('date', '>=' , Carbon::now()->subMonths(12));
    }

    public function scopeUpdated(Builder $query)
    {
        return $query->whereNotNull('modified')->orderBy('modified', 'DESC');
    }

    public function scopeFinished(Builder $query)
    {
        return $query->join('consultations', 'papers.id', '=', 'consultations.paper_id')
            ->where('consultations.authoritative', '=', 1)
            ->select('papers.*')->distinct();
    }

    public function result()
    {
        $agendum = $this->agendaItems->filter(function ($agenda) {
            return $agenda->pivot->authoritative == 1;
        })->first();

        return $agendum ? $agendum->resolution_text : '';
    }

    public function text()
    {
        return $this->mainFile->first() ? $this->mainFile->first()->text : '';
    }

    public function isFinished() : bool
    {
        return (bool) $this->consultations()->where('authoritative', true)->count();
    }

    public function isNew() : bool
    {
        return (bool) $this->date ? $this->date->subMonths(12)->isFuture() : false ;
    }
}
