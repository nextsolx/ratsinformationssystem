<?php

namespace App\OParl;

use App\Meeting;
use App\Organization;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class OParlApiManager
{
    public static function meetings($page = null, Carbon $from = null)
    {
        $data = resolve(\App\Contracts\OParlApi::class)->meetings($page, $from);

        $meeting_sorted = collect($data['data'])
                                ->sortBy('start')
                                ->sortByDesc('start');

        $meeting = $meeting_sorted->map(function ($meetingData) {
            return new Meeting($meetingData);
        });

        $pages = self::extractPages($data);

        return [$meeting, $pages];
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

    private static function extractPages($data)
    {
        return $data['pagination'];
    }
}
