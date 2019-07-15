<?php

namespace App\OParl;

use App\Meeting;
use App\Organization;
use App\Person;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class OParlApiManager
{
    public static function meetings($page = null, Carbon $from = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->meetings($page, $from);

        $meeting = collect($data['data'])->map(function ($meetingData) {
            return new Meeting($meetingData);
        });

        $pages = self::extractPages($data);

        return [$meeting, $pages];
    }

    public static function meeting(string $id)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->meeting($id);

        return new Meeting($data);
    }

    public static function organization(string $organizationId)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->organization($organizationId);

        return new Organization($data);
    }

    public static function organizations(Collection $organizationIds = null)
    {
        if ($organizationIds) {
            return $organizationIds->map(function ($id) {
                return self::organization($id);
            });
        }

        $data = resolve(\App\Contracts\OParlApi::class)->organizations();

        $oganizations = collect($data->get('data'))->map(function ($organizationData) {
            return new Organization($organizationData);
        });

        return $oganizations;
    }

    public static function personFromMembership(string $id)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->membership($id);

        if ($personUrl = Arr::get($data, 'person')) {
            return static::person(self::extractId($personUrl));
        }

        return new Person([]);
    }

    public static function person(string $id)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->person($id);

        return new Person($data);
    }

    private static function extractPages($data)
    {
        return $data['pagination'];
    }

    private static function extractId(string $url)
    {
        return Arr::last(explode('/', $url));
    }
}
