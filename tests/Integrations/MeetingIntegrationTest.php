<?php

namespace Tests\Integrations;

use Carbon\Carbon;
use Illuminate\Http\Response;
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
    public function get_meetings_filtered_by_year()
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

    /**
     * @test
     */
    public function get_single_meeting_by_id()
    {
        $id = '281';
        $response = $this->json('GET', '/api/meeting/' . $id);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson([
                'data' => [
                    'id' => '281',
                    'title' => '4. Sitzung des Finanzausschusses',
                    'location' => [
                        'description' => 'Rathaus der Beispielstadt, Ratshausplatz 1, 12345 Beispielstadt'
                    ],
                    'dateFrom' => '2019-01-04T08:00:00+01:00',
                    'dateTill' => '2019-01-04T12:00:00+01:00',
                    'files' => [

                    ],
                ]
            ]);

    }
}
