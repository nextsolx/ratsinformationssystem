<?php

namespace Tests\Mocks;


use Carbon\Carbon;

class MeetingMock
{
    public static function example()
    {
        return self::meeting();
    }

    public static function exampleOldDate()
    {
        return self::meeting(Carbon::parse('2019-01-04T08:00:00+01:00')->subYears(5));
    }

        private static function meeting(Carbon $date = null)
    {
        return [
            'id' => 'https://oparl.example.org/meeting/281',
            'type' => 'https://schema.oparl.org/1.1/Meeting',
            'name' => '4. Sitzung des Finanzausschusses',
            'start' => $date ? $date->toW3cString() : '2019-01-04T08:00:00+01:00',
            'end' => $date ? $date->addHour()->toW3cString() :'2019-01-04T12:00:00+01:00',
            'location' => [
                    'id' => 'https://oparl.example.org/location/0',
                    'type' => 'https://schema.oparl.org/1.1/Location',
                    'description' => 'Rathaus der Beispielstadt, Ratshausplatz 1, 12345 Beispielstadt',
                    'created' => '2012-01-06T12:01:00+01:00',
                    'modified' => '2012-01-08T14:05:27+01:00',
                    'geojson' =>
                        [
                            'type' => 'Feature',
                            'geometry' =>
                                [
                                    'type' => 'Point',
                                    'coordinates' =>
                                        [
                                            0 => 50.1234,
                                            1 => 10.4321,
                                        ],
                                ],
                            'properties' =>
                                [
                                    'name' => 'Rathausplatz',
                                ],
                        ],
                ],
            'organization' => [
                    0 => 'https://oparl.example.org/organization/34',
                ],
            'invitation' => [
                    'id' => 'https://oparl.example.org/files/57739',
                    'type' => 'https://schema.oparl.org/1.1/File',
                    'name' => 'Einladung',
                    'fileName' => 'einladung.pdf',
                    'mimeType' => 'application/pdf',
                    'date' => '2012-01-08',
                    'modified' => '2012-01-08T14:05:27+01:00',
                    'sha1Checksum' => 'da39a3ee5e6b4b0d3255bfef95601890afd80709',
                    'size' => 82930,
                    'accessUrl' => 'https://oparl.example.org/files/57739.pdf',
                    'downloadUrl' => 'https://oparl.example.org/files/download/57739.pdf',
                    'created' => '2012-01-06T12:01:00+01:00',
                ],
            'resultsProtocol' => [
                    'id' => 'https://oparl.example.org/files/57739',
                    'type' => 'https://schema.oparl.org/1.1/File',
                    'name' => 'Protokoll',
                    'fileName' => 'protokoll.pdf',
                    'mimeType' => 'application/pdf',
                    'date' => '2012-01-08',
                    'sha1Checksum' => 'da39a3ee5e6b4b0d3255bfef95601890afd80709',
                    'size' => 82930,
                    'accessUrl' => 'https://oparl.example.org/files/57739.pdf',
                    'downloadUrl' => 'https://oparl.example.org/files/download/57739.pdf',
                    'modified' => '2012-01-08T14:05:27+01:00',
                    'created' => '2012-01-06T12:01:00+01:00',
                ],
            'verbatimProtocol' => [
                    'id' => 'https://oparl.example.org/files/57739',
                    'type' => 'https://schema.oparl.org/1.1/File',
                    'name' => 'Wortprotokoll',
                    'fileName' => 'wortprotokoll.pdf',
                    'mimeType' => 'application/pdf',
                    'date' => '2012-01-08',
                    'sha1Checksum' => 'da39a3ee5e6b4b0d3255bfef95601890afd80709',
                    'size' => 82930,
                    'accessUrl' => 'https://oparl.example.org/files/57739.pdf',
                    'downloadUrl' => 'https://oparl.example.org/files/download/57739.pdf',
                    'modified' => '2012-01-08T14:05:27+01:00',
                    'created' => '2012-01-08T14:05:27+01:00',
                ],
            'auxiliaryFile' => [
                    0 =>
                        [
                            'id' => 'https://oparl.example.org/files/57739',
                            'type' => 'https://schema.oparl.org/1.1/File',
                            'name' => 'Nachtrags-Tagesordnung',
                            'fileName' => 'nachtrag-TO.pdf',
                            'mimeType' => 'application/pdf',
                            'date' => '2012-01-08',
                            'sha1Checksum' => 'da39a3ee5e6b4b0d3255bfef95601890afd80709',
                            'size' => 82930,
                            'accessUrl' => 'https://oparl.example.org/files/57739.pdf',
                            'downloadUrl' => 'https://oparl.example.org/files/download/57739.pdf',
                            'modified' => '2012-01-08T14:05:27+01:00',
                            'created' => '2012-01-08T14:05:27+01:00',
                        ],
                ],
            'agendaItem' => [
                    0 =>
                        [
                            'id' => 'https://oparl.example.org/agendaitem/3271',
                            'type' => 'https://schema.oparl.org/1.1/AgendaItem',
                            'meeting' => 'https://oparl.example.org/meeting/281',
                            'number' => '10.1',
                            'name' => 'Satzungsänderung für Ausschreibungen',
                            'public' => true,
                            'consultation' => 'https://oparl.example.org/consultation/1034',
                            'result' => 'Geändert beschlossen',
                            'resolutionText' => 'Der Beschluss weicht wie folgt vom Antrag ab: ...',
                            'created' => '2012-01-06T12:01:00+01:00',
                            'modified' => '2012-01-08T14:05:27+01:00',
                        ],
                ],
            'created' => '2012-01-06T12:01:00+01:00',
            'modified' => '2012-01-08T14:05:27+01:00',
        ];
    }
}