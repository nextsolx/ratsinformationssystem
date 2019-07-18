<?php

namespace Tests\Mocks;

class PersonMock
{
    public static function example()
    {
        return [
            'id' => 'https://oparl.example.org/person/29',
            'type' => 'https://schema.oparl.org/1.1/Person',
            'body' => 'https://oparl.example.org/body/0',
            'name' => 'Prof. Dr. Max Mustermann',
            'familyName' => 'Mustermann',
            'givenName' => 'Max',
            'title' => [
                    'Prof.',
                    'Dr.',
                ],
            'formOfAddress' => 'Ratsfrau',
            'gender' => 'male',
            'email' => [
                    'max@mustermann.de',
                ],
            'phone' => [
                    '+493012345678',
                ],
            'status' => [
                    'Bezirksbürgermeister',
                ],
            'membership' => [
                    [
                            'id' => 'https://oparl.example.org/memberships/385',
                            'type' => 'https://schema.oparl.org/1.1/Membership',
                            'organization' => 'https://oparl.example.org/organizations/5',
                            'role' => 'Vorsitzende',
                            'votingRight' => true,
                            'startDate' => '2013-12-03',
                            'created' => '2011-11-11T11:11:00+01:00',
                            'modified' => '2012-08-16T14:05:27+02:00',
                        ], [
                            'id' => 'https://oparl.example.org/memberships/693',
                            'type' => 'https://schema.oparl.org/1.1/Membership',
                            'organization' => 'https://oparl.example.org/organizations/9',
                            'role' => 'Sachkundige Bürgerin',
                            'votingRight' => false,
                            'startDate' => '2013-12-03',
                            'endDate' => '2014-07-28',
                            'created' => '2011-11-11T11:11:00+01:00',
                            'modified' => '2012-08-16T14:05:27+02:00',
                        ],
                ],
            'created' => '2011-11-11T11:11:00+01:00',
            'modified' => '2012-08-16T14:05:27+02:00',
        ];
    }
}
