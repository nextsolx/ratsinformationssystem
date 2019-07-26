<?php

namespace App\OParl;

use App\Meeting;
use App\Organization;
use App\Paper;
use App\Person;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class OParlApiManager
{
    public static function topics($page = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->papers($page);

        $papers = collect($data['data'])->map(function ($papersData) {
            return new Paper($papersData);
        });

        $pages = self::extractPages($data);

        return [$papers, $pages];
    }

    public static function meetings($page = null, Carbon $from = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->meetings($page, $from);

        return [$data['data'],  self::extractPages($data)];
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

    public static function organizations($page = null, Collection $organizationIds = null)
    {
        if ($organizationIds) {
            return $organizationIds->map(function ($id) {
                return self::organization($id);
            });
        }

        $data = resolve(\App\Contracts\OParlApi::class)->organizations($page);

        return [$data['data'],  self::extractPages($data)];
    }

    public static function locations($page = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->locations($page);

        return [$data['data'],  self::extractPages($data)];
    }

    public static function papers($page = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->papers($page);

        return [$data['data'],  self::extractPages($data)];
    }

    public static function people($page = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->people($page);

        return [$data['data'],  self::extractPages($data)];
    }

    public static function memberships($page = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->memberships($page);

        return [$data['data'],  self::extractPages($data)];
    }

    public static function agendaItems($page = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->agendaItems($page);

        return [$data['data'],  self::extractPages($data)];
    }

    public static function consultations($page = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->consultations($page);

        return [$data['data'],  self::extractPages($data)];
    }

    public static function files($page = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->files($page);

        return [$data['data'],  self::extractPages($data)];
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
