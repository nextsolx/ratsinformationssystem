<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Model extends \Illuminate\Database\Eloquent\Model
{
    public $incrementing = false;

    protected $dates = [];

    public static function initialize (array $data)
    {
        $data['id'] = self::extractId($data);

        $data = collect($data)->mapWithKeys(function ($value, $key) {
            if (in_array($key, (new static())->dates)) {
                $value = Carbon::parse($value);
            }

            if ($key == 'geojson') {
                $value = json_encode($value);
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
        return Str::before(Arr::last(explode('/', $url)), '?');
    }
}
