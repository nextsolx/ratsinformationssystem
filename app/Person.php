<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
        'status',
        'life',
        'life_source',
        'phone',
        'email',
        'location_id',
    ];

    public static function initialize (array $data)
    {
        $data['id'] = self::extractId($data);

        $data = collect($data)->mapWithKeys(function ($value, $key) {
            if (in_array($key, (new static())->dates)) {
                $value = Carbon::parse($value);
            }

            if ($key == 'phone' || $key == 'email' || $key == 'status' || $key == 'title') {
                $value = json_encode($value);
            }

            return [Str::snake($key) => $value];
        });

        if ($location = Arr::get($data, 'location_object')) {
            $location = Location::initialize($data['location_object']);
            $location->save();
        }

        return self::updateOrCreate(
            ['id' =>  $data['id']],
            ['location_id' => $location['id']],
            $data->toArray()
        );
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'memberships')
            ->using(Membership::class)->withPivot(['role']);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
