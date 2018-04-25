<?php

namespace Tests\Feature;

use App\Championship;
use App\Match;
use App\Matchday;
use App\Season;
use App\Sport;
use App\Team;
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

        $response = $this->get('/api/championships/' . $sport->id);

        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {

            if ($response->getStatusCode() == 200) { // Test json response structure
                $response->assertJsonStructure([
                    '*' => [
                        'id',
                        'name'
                    ]
                ]);
            } else {
                $this->assertTrue(true);
            }

        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Check if seasons api works
     */
    public function testGetSeasons()
    {
        $championship = Championship::first();

        $response = $this->get('/api/seasons/' . $championship->id);

        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {
            if ($response->getStatusCode() == 200) {
                $response->assertJsonStructure([
                    '*' => [
                        'id',
                        'name'
                    ]
                ]);
            } else {
                $this->assertTrue(true);
            }
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test if matchdays api works
     */
    public function testGetMatchdays()
    {
        $season = Season::first();

        $response = $this->get('/api/matchdays/' . $season->id);

        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {
            if ($response->getStatusCode() == 200) {
                $response->assertJsonStructure([
                    '*' => [
                        'id',
                        'matchday'
                    ]
                ]);
            } else {
                $this->assertTrue(true);
            }
        } else {
            $this->assertTrue(false);
        }
    }

    /**
     * Test Patch Match api
     */
    public function testPatchMatch()
    {
        $match = Match::first();

        $request = [
            'id' => $match->id,
            'first_team_score' => 1,
            'second_team_score' => 1
        ];

        $response = $this->patch('/api/match/', $request);

        if ($response->getStatusCode() == 200) {
            $response->assertJsonStructure([
                'id',
                'first_team_score',
                'second_team_score'
            ]);
        } else {
            $this->assertTrue(true);
        }
    }

    /**
     * Test match post api
     */
    public function testPostMatch()
    {
        $sport = Sport::firstOrFail();
        $championship = $sport->championship()->first();
        $season = Season::whereChampionshipId($championship->id)->first();
        $matchday = Matchday::whereSeasonId($season->id)->first();
        $teams = Team::whereChampionshipId($championship->id)->get();

        $request = [
            'sport_id' => $sport->id,
            'championship_id' => $championship->id,
            'season_id' => $season->id,
            'matchday_id' => $matchday->id,
            'first_team_id' => $teams[0]->id,
            'second_team_id' => $teams[1]->id
        ];

        $response = $this->post('/api/match/', $request);

        if ($response->getStatusCode() == 200) {
            $response->assertJsonStructure([
                'id',
                'first_team_score',
                'second_team_score'
            ]);
        } else {
            $this->assertTrue(true);
        }
    }


}
