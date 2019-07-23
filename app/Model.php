<?php

namespace App;

use Illuminate\Support\Arr;

class Model
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __get($name)
    {
        return Arr::get($this->data, $name);
    }

    public function extractId()
    {
        return Arr::last(explode('/', $this->id));
    }
}
