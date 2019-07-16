<?php

namespace App;

use Illuminate\Support\Arr;

class Paper extends Model
{
    public function location()
    {
        return Arr::has($this->data, 'location') ? new Location($this->location) : null;
    }
}
