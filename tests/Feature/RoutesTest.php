<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesTest extends TestCase
{

    /**
     * Test admin page
     *
     * @return void
     */
    public function testAdmin()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Users Page
     */
    public function testAdminUsersPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/users');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Posts Page
     */
    public function testAdminPostsPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/posts');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Comments Page
     */
    public function testAdminCommentsPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/comments');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Athletes Page
     */
    public function testAdminAthletesPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/athletes');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Stadia Page
     */
    public function testAdminStadiaPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/stadium');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Teams Page
     */
    public function testAdminTeamsPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/teams');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Matches Page
     */
    public function testAdminMatchesPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/matches');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Sports Page
     */
    public function testAdminSportsPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/sports');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Seasons Page
     */
    public function testAdminSeasonsPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/seasons');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Championships Page
     */
    public function testAdminChampionshipsPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/championships');

        $response->assertStatus(200);
    }

    /**
     * Test Admin Matchdays Page
     */
    public function testAdminMatchdaysPages()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user, 'api')
            ->get('/admin/matchdays');

        $response->assertStatus(200);
    }

}
