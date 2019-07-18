<?php

namespace App;

class Organization extends Model
{
    public function peopleCount()
    {
        return $this->membership ? count($this->membership) : 0;
    }
}
