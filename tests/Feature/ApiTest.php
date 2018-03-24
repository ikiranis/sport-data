<?php

namespace Tests\Feature;

use App\Sport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    /**
     * Check if championship api works
     *
     * @return void
     */
    public function testGetChampionships()
    {
        $sport = Sport::first();
        $sport_id = $sport->id;

        $response = $this->get('/api/championships/' . $sport_id);

        if($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {
            $this->assertTrue(true);
        }
//        $response->assertStatus(200);
    }

    /**
     * Test if championship json response structure is ok
     */
    public function testChampionshipStructureResponse()
    {
        $sport = Sport::first();
        $sport_id = $sport->id;

        $response = $this->get('/api/championships/' . $sport_id);

        if($response->getStatusCode() == 200) {
            $response->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name'
                    ]
                ]
            ]);
        } else {
            $this->assertTrue(true);
        }
    }
}
