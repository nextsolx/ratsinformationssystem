<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
        'location',
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
            $data['location'] = $location['id'];
        }

        $person = self::updateOrCreate(
            ['id' =>  $data['id']],
            $data->toArray()
        );

        return $person;
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'memberships')
            ->using(Membership::class)->withPivot(['role','start_date','end_date'])
            ->orderBy(DB::raw('memberships.end_date IS NOT NULL, memberships.end_date'), 'desc');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
