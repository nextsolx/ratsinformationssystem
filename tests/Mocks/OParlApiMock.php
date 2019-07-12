<?php

namespace Tests\Mocks;


use Illuminate\Support\Carbon;

class OParlApiMock implements \App\Contracts\OParlApi
{
    public function meetings($page = null, Carbon $from = null)
    {
        $data = [
            MeetingMock::example(),
            MeetingMock::exampleOldDate(),
        ];

        if ($from && $from->isAfter(
            Carbon::parse('2014-01-04T08:00:00+01:00')
        )) {
            $data = [
                MeetingMock::example(),
            ];
        }

        return [
            'data' => $data,
            'links' => [
                "first" => "https://example.oparl.org/body/0/meeting",
                "last" => "https://example.oparl.org/body/0/meeting",
                "self" => "https://example.oparl.org/body/0/meeting",
            ],
            'pagination' => [
                'currentPage' => 1,
                'elementsPerPage' => 1,
                'totalElements' => 1,
                'totalPages' => 1,
            ]
        ];
    }

    public function organization(string $organizationId)
    {
        return [
            'data' => [
                OrganizationMock::example(),
            ],
            'links' => [
                "first" => "https://example.oparl.org/body/0/meeting",
                "last" => "https://example.oparl.org/body/0/meeting",
                "self" => "https://example.oparl.org/body/0/meeting",
            ],
            'pagination' => [
                'currentPage' => 1,
                'elementsPerPage' => 1,
                'totalElements' => 1,
                'totalPages' => 1,
            ]
        ];
    }
}
