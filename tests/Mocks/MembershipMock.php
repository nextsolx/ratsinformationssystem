<?php

namespace Tests\Mocks;

class MembershipMock
{
    public static function example()
    {
        return [
            'body' => 'https://oparl.example.org/body/0',
            'created' => '2018-01-11T12 =>00 =>00+02 =>00',
            'id' => 'https://oparl.example.org/membership/385',
            'modified' => '2018-01-11T12 =>00 =>00+02 =>00',
            'oparl-mirror:originalId' => 'https =>//example.url/link-to-original-item',
            'organization' => 'https://oparl.example.org/organization/34',
            'person' => 'https://oparl.example.org/person/29',
            'role' => 'Ortschaftsrat',
            'startDate' => '2018-02-12',
            'type' => 'https://schema.oparl.org/1.1/Membership',
            'votingRight' => true,
        ];
    }
}
