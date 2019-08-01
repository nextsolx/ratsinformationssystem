<?php

namespace App;

use Illuminate\Support\Arr;

class Agendum extends Model
{
    protected $table = 'agenda_items';

    protected $fillable = [
        'id',
        'name',
        'number',
        'order',
        'name',
        'public',
        'result',
        'resolution_text',
        'start',
        'end',
    ];

    protected $dates = [
        'start',
        'end',
    ];


    public static function initialize(array $data)
    {
        $agendum = parent::initialize($data);

        if ($meetingUrl = Arr::get($data, 'meeting')) {
            $agendum->meeting()->associate(self::extractIdFromUrl($meetingUrl));
            $agendum->save();
        }

        return $agendum;
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
