<?php

namespace Tests\Mocks;


class OrganizationMock
{
    public static function example()
    {
        return array (
            'id' => 'https://oparl.example.org/organization/34',
            'type' => 'https://schema.oparl.org/1.1/Organization',
            'body' => 'https://oparl.example.org/bodies/1',
            'name' => 'Ausschuss für Haushalt und Finanzen',
            'shortName' => 'Finanzausschuss',
            'startDate' => '2012-07-17',
            'organizationType' => 'Gremium',
            'location' =>
                array (
                    'id' => 'https://oparl.example.org/location/0',
                    'type' => 'https://schema.oparl.org/1.1/Location',
                    'description' => 'Rathaus der Beispielstadt, Ratshausplatz 1, 12345 Beispielstadt',
                    'created' => '2012-01-06T12:01:00+01:00',
                    'modified' => '2012-01-08T14:05:27+01:00',
                    'geojson' =>
                        array (
                            'type' => 'Feature',
                            'geometry' =>
                                array (
                                    'type' => 'Point',
                                    'coordinates' =>
                                        array (
                                            0 => 50.1234,
                                            1 => 10.4321,
                                        ),
                                ),
                            'properties' =>
                                array (
                                    'name' => 'Rathausplatz',
                                ),
                        ),
                ),
            'post' =>
                array (
                    0 => 'Vorsitzender',
                    1 => '1. Stellvertreter',
                    2 => 'Mitglied',
                ),
            'meeting' => 'https://oparl.example.org/organization/34/meetings',
            'membership' =>
                array (
                    0 => 'https://oparl.example.org/membership/27',
                    1 => 'https://oparl.example.org/membership/48',
                    2 => 'https://oparl.example.org/membership/57',
                ),
            'classification' => 'Ausschuss',
            'keyword' =>
                array (
                    0 => 'finanzen',
                    1 => 'haushalt',
                ),
            'created' => '2012-07-16T00:00:00+02:00',
            'modified' => '2012-08-16T12:34:56+02:00',
        );
    }
}
