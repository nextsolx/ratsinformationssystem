<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Membership extends Pivot
{
    protected $table = 'memberships';
    public $incrementing = true;

    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected $fillable = [
        'person_id',
        'organization_id',
        'role',
        'voting_right',
        'start_date',
        'end_date',
    ];


    public static function initialize (array $data)
    {
        $data['person_id'] = self::extractIdFromUrl(Arr::get($data, 'person'));
        $data['organization_id'] = self::extractIdFromUrl(Arr::get($data, 'organization'));

        $data = collect($data)->mapWithKeys(function ($value, $key) {
            if (in_array($key, (new static())->dates)) {
                $value = Carbon::parse($value);
            }

            return [Str::snake($key) => $value];
        });

        return self::updateOrCreate(
            ['id' =>  $data['id']],
            $data->toArray()
        );
    }

    public static function extractId($data)
    {
        return self::extractIdFromUrl($data['id']);
    }

    public static function extractIdFromUrl($url)
    {
        return Arr::last(explode('/', $url));
    }
}
