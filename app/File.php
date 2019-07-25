<?php

namespace App;

class File extends Model
{
    protected $dates = [
        'date',
    ];

    protected $fillable = [
        'id',
        'name',
        'file_name',
        'mime_type',
        'date',
        'size',
        'text',
        'access_url',
        'download_url',
    ];

}
