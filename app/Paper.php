<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class Paper extends Model
{
    public static $basicScope = [
        'location', 'files', 'agendaItems',
        'consultations', 'consultations.meeting', 'consultations.agendum',
        'meetings', 'meetings.location', 'meetings.agenda', 'meetings.files', 'meetings.organizations', 'meetings.organizations.people',
    ];

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

        if ($location = Arr::get($data, 'location')) {
            $location = Location::initialize($data['location']);
            $paper->location()->associate($location);
            $location->save();
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

    public function location()
    {
        return $this->belongsTo(Location::class);
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
        return $query->where('date', '>=' , Carbon::now()->subMonths(12));
    }

    public function scopeUpdated(Builder $query)
    {
        return $query->whereNotNull('modified')->orderBy('modified', 'DESC');
    }

    public function scopeFinished(Builder $query)
    {
        return $query->whereHas('consultations', function (Builder $query) {
            return  $query->where('authoritative', '=', 1);
        });
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
        return (bool) $this->date->subMonths(12)->isFuture();
    }
}
