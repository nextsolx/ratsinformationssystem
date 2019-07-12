<?php

namespace App;

use Illuminate\Support\Arr;

class Organization
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function __get($name)
    {
        return Arr::get($this->data, $name);
    }

    public function peopleCount()
    {
        return $this->membership ? count($this->membership) : 0;
    }
}
