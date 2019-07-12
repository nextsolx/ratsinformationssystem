<?php

namespace Tests\Integrations;

use Carbon\Carbon;
use Tests\TestCase;

class MeetingIntegrationTest extends TestCase
{

    /**
    * @test
    */
    public function get_all_meetings()
    {
        $response = $this->json('GET', '/api/meetings');

        $response->assertStatus(200);

        $response->assertJsonCount(2, 'data')
            ->assertJson([
            'data' => [[
                'title' => '4. Sitzung des Finanzausschusses',
                'location' => [
                    'description' => 'Rathaus der Beispielstadt, Ratshausplatz 1, 12345 Beispielstadt'
                ],
                'dateFrom' => '2019-01-04T08:00:00+01:00',
                'dateTill' => '2019-01-04T12:00:00+01:00',
            ]]
        ]);
    }

    /**
     * @test
     */
    public function getMeetingsFilteredByYeah()
    {
        $response = $this->json('GET', '/api/meetings?from=' . Carbon::parse('2019-01-01T00:00:00+01:00')->startOfYear());

        $response->assertStatus(200);

        $response->assertJsonCount(1, 'data')
            ->assertJson([
            'data' => [[
                'title' => '4. Sitzung des Finanzausschusses',
                'location' => [
                    'description' => 'Rathaus der Beispielstadt, Ratshausplatz 1, 12345 Beispielstadt'
                ],
                'dateFrom' => '2019-01-04T08:00:00+01:00',
                'dateTill' => '2019-01-04T12:00:00+01:00',
            ]]
        ]);
    }
}
