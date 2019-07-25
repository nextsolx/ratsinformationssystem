<?php

namespace App;

class Person extends Model
{
    protected $fillable = [
        'id',
        'name',
        'family_name',
        'given_name',
        'form_of_address',
        'affix',
        'gender',
        'life',
        'life_source',
    ];
}
