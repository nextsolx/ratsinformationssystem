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

    //Todo: Verify
    public function location()
    {
        return Arr::has($this->data, 'location') ? new Location($this->location) : Location::fallback();
    }
}
