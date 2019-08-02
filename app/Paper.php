<?php

namespace App;

use Illuminate\Support\Arr;

class Paper extends Model
{
    protected $dates = [
        'date',
    ];

    protected $fillable = [
        'id',
        'name',
        'reference',
        'paperType',
        'date',
    ];

    public static function initialize(array $data)
    {
        $paper = parent::initialize($data);

        if ($location = Arr::get($data, 'location')) {
            $location = Location::initialize($data['location']);
            $paper->location()->associate($location);
            $location->save();
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
        return $this->consultations->map(function($organization) {
            return $organization->meeting;
        })->flatten(1);
    }

    public function isFinished() : bool
    {
        return (bool) $this->consultations()->where('authoritative', true)->count();
    }

    public function isNew() : bool
    {
        return (bool)   $this->date->subMonths(12)->isFuture();
    }
}
