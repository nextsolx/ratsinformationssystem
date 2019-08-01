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
        $meeting = parent::initialize($data);

        if ($location = Arr::get($data, 'location')) {
            $location = Location::initialize($data['location']);
            $location->meeting()->associate($meeting);
            $location->save();
        }
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
//        return $this->hasManyThrough(Meeting::class, Consultation::class);
    }
}
