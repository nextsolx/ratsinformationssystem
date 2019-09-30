<?php

namespace App;

use Illuminate\Support\Arr;

class Location extends Model
{
    protected $fillable = [
        'id',
        'locality',
        'sub_locality',
        'street_address',
        'postal_code',
        'room',
        'description',
        'geojson'
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function person()
    {
        return $this->hasMany(Person::class);
    }

    //Todo: Verify
    public function getLocationX()
    {
        return Arr::first($this->getPoint());
    }
    //Todo: Verify
    public function getLocationY()
    {
        return Arr::last($this->getPoint());
    }
    //Todo: Verify
    private function getPoint()
    {
        return $this->geojson ? Arr::get($this->geojson, 'geometry.coordinates') : [];
    }

    public static function fallback()
    {
        return new static([
            'id' => '0',
            'type' => 'https://schema.oparl.org/1.1/Location',
            'description' => 'Rathaus Köln, Ratshaus, 50667 Köln',
            'streetAddress' => 'Ratshaus',
            'postalCode' => '50667',
            'locality' => 'Köln',
            'subLocality' => 'Innenstadt',
            'created' => '2010-01-01T12:00:00+01:00',
            'modified' => '2010-01-01T12:00:00+01:00',
            'geojson' =>
                [
                    'type' => 'Feature',
                    'geometry' =>
                        [
                            'type' => 'Point',
                            'coordinates' =>
                                [
                                    0 => 50.938513,
                                    1 => 6.959629,
                                ],
                        ],
                    'properties' =>
                        [
                            'name' => 'Rathaus',
                        ],
                ],
        ]);
    }

}
