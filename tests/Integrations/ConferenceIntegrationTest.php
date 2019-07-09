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
                'title' => 'Naturschutzbeirat bei der Unteren Naturschutzbehörde',
                'location' => 'Stadthaus Deutz, Konferenzraum 16.F.43',
                'date' => Carbon::parse('2019-07-01 07:00:00')->toW3cString(),
            ]]
        ]);
    }
}
