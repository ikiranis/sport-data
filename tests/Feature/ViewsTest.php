<?php

namespace Tests\Feature;

use App\Athlete;
use App\Championship;
use App\Matchday;
use App\Season;
use App\Sport;
use App\Stadium;
use App\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewsTest extends TestCase
{

    /**
     * Test Athletes Index view response
     */
    public function testAthletesIndexViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/athletes');

        $response->assertStatus(200);  // Test if view loading

        $response->assertViewHas('athletes'); // Test if "athletes" data exist

        $athlete = Athlete::first(); // First athlete in database

        $responseAthlete = (object) $response->original['athletes']->first(); // First athlete in view response

        if($athlete->fname==$responseAthlete->fname) {  // Test if fname field is ok
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Stadia Index view response
     */
    public function testStadiaIndexViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/stadium');

        $response->assertStatus(200);

        $response->assertViewHas('stadia');

        $stadia = Stadium::first();

        $responseStadia = (object) $response->original['stadia']->first();

        if($stadia->name==$responseStadia->name) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Teams Index view response
     */
    public function testTeamsIndexViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/teams');

        $response->assertStatus(200);

        $response->assertViewHas('teams');

        $teams = Team::first();

        $responseTeams = (object) $response->original['teams']->first();

        if($teams->name==$responseTeams->name) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Sports Index view response
     */
    public function testSportsIndexViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/sports');

        $response->assertStatus(200);

        $response->assertViewHas('sports');

        $sports = Sport::first();

        $responseSports = (object) $response->original['sports']->first();

        if($sports->name==$responseSports->name) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Seasons Index view response
     */
    public function testSeasonsIndexViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/seasons');

        $response->assertStatus(200);

        $response->assertViewHas('seasons');

        $seasons = Season::first();

        $responseSeasons = (object) $response->original['seasons']->first();

        if($seasons->name==$responseSeasons->name) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Championships Index view response
     */
    public function testChampionshipsIndexViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/championships');

        $response->assertStatus(200);

        $response->assertViewHas('championships');

        $championships = Championship::first();

        $responseChampionships = (object) $response->original['championships']->first();

        if($championships->name==$responseChampionships->name) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Matchdays Index view response
     */
    public function testMatchdaysIndexViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/matchdays');

        $response->assertStatus(200);

        $response->assertViewHas('matchdays');

        $matchdays = Matchday::first();

        $responseMatchdays = (object) $response->original['matchdays']->first();

        if($matchdays->name==$responseMatchdays->name) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

}
