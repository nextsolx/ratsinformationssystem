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

        if ($file = Arr::get($data, 'resolutionFile')) {
            $agendum->files()->syncWithoutDetaching(self::extractIdFromUrl($file['id']));
            $agendum->files()->updateExistingPivot(self::extractIdFromUrl($file['id']), ['type' => 'resolutionFile']);
        }
        if ($files = Arr::get($data, 'auxiliaryFile')) {
            foreach ($files as $file) {
                $agendum->files()->syncWithoutDetaching(self::extractIdFromUrl($file['id']));
                $agendum->files()->updateExistingPivot(self::extractIdFromUrl($file['id']), ['type' => 'auxiliaryFile']);
            }
        }

        return $agendum;
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class);
    }

    public function papers()
    {
        return $this->belongsToMany(Paper::class, 'consultations')->withPivot('authoritative');
    }
}
