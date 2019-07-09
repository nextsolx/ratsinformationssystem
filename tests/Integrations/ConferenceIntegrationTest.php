<?php

namespace Tests\Integrations;

use Carbon\Carbon;
use Tests\TestCase;

class ConferenceIntegrationTest extends TestCase
{

    /**
    * @test
    */
    public function get_all_meetings()
    {
        $response = $this->json('GET', '/api/meetings');

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [[
                'title' => '4. Sitzung des Finanzausschusses',
                'location' => [
                    'description' => 'Rathaus der Beispielstadt, Ratshausplatz 1, 12345 Beispielstadt'
                ],
                'dateFrom' => '2013-01-04T08:00:00+01:00',
                'dateTill' => '2013-01-04T12:00:00+01:00',
            ]]
        ]);
    }
}
