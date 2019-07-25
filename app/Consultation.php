<?php

namespace App;

use Illuminate\Support\Arr;

class Consultation extends Model
{
    protected $fillable = [
        'id',
        'authoritative',
        'role',
    ];

    public static function initialize(array $data)
    {
        $consultation = parent::initialize($data);

        if ($meetingUrl = Arr::get($data, 'meeting')) {
            $consultation->meeting()->associate(self::extractIdFromUrl($meetingUrl));
            $consultation->save();
        }

        if ($agendumUrl = Arr::get($data, 'agendaItem')) {
            $consultation->agendum()->associate(self::extractIdFromUrl($agendumUrl));
            $consultation->save();
        }

        if ($paperUrl = Arr::get($data, 'paper')) {
            $consultation->paper()->associate(self::extractIdFromUrl($paperUrl));
            $consultation->save();
        }

        return $consultation;
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function agendum()
    {
        return $this->belongsTo(Agendum::class, 'agendum_id');
    }
}
