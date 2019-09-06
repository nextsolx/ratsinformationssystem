<?php

namespace Tests\Integrations;

use Tests\TestCase;

class TopicIntegrationTest extends TestCase
{

    /**
    * @test
    */
    public function get_all_topics()
    {
        $response = $this->json('GET', '/api/topics');

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [[
                'name' => 'Antwort auf Anfrage 1200/2014'
            ]]
        ]);
    }
}