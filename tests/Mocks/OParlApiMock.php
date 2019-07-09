<?php

namespace Tests\Mocks;


class OParlApiMock implements \App\Contracts\OParlApi
{
    public function meetings()
    {
        return [
            'data' => [
                MeetingMock::example(),
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
