<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetChampionships()
    {
        $sport_id = '1';

        $response = $this->get('/api/championships/' . $sport_id);

        $response->assertStatus(200);
    }
}
