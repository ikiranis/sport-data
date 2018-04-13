<?php

namespace Tests\Feature;

use App\Athlete;
use App\Championship;
use App\Comment;
use App\Matchday;
use App\Post;
use App\Season;
use App\Sport;
use App\Stadium;
use App\Team;
use App\User;
use Tests\TestCase;

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

        if($athlete->id==$responseAthlete->id) {  // Test if fname field is ok
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Athletes create view response
     */
    public function testAthletesCreateViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/athletes/create');

        $response->assertStatus(200);  // Test if view loading

        $response->assertSee('content'); // Test if it has content
    }

    /**
     * Test Athletes edit view response
     */
    public function testAthletesEditViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $athlete = Athlete::first(); // First athlete in database

        $response = $this->actingAs($user, 'web')
            ->get("/admin/athletes/{$athlete->id}/edit");

        $response->assertStatus(200);  // Test if view loading

        $response->assertViewHas('athlete'); // Test if "athletes" data exist

        $responseAthlete = (object) $response->original['athlete']->first(); // First athlete in view response

        if($athlete->id==$responseAthlete->id) {  // Test if fname field is ok
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

        if($stadia->id==$responseStadia->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Stadia create view response
     */
    public function testStadiaCreateViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/stadium/create');

        $response->assertStatus(200);  // Test if view loading

        $response->assertSee('content'); // Test if it has content
    }

    /**
     * Test Stadia edit view response
     */
    public function testStadiaEditViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $stadium = Stadium::first();

        $response = $this->actingAs($user, 'web')
            ->get("/admin/stadium/{$stadium->id}/edit");

        $response->assertStatus(200);

        $response->assertViewHas('stadium'); //

        $responseStadium = (object) $response->original['stadium']->first();

        if($stadium->id==$responseStadium->id) {
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

        if($teams->id==$responseTeams->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Teams create view response
     */
    public function testTeamsCreateViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/teams/create');

        $response->assertStatus(200);  // Test if view loading

        $response->assertSee('content'); // Test if it has content
    }

    /**
     * Test Teams edit view response
     */
    public function testTeamsEditViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $team = Team::first();

        $response = $this->actingAs($user, 'web')
            ->get("/admin/teams/{$team->id}/edit");

        $response->assertStatus(200);

        $response->assertViewHas('team'); //

        $responseTeam = (object) $response->original['team']->first();

        if($team->id==$responseTeam->id) {
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

        if($sports->id==$responseSports->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Sports create view response
     */
    public function testSportsCreateViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/sports/create');

        $response->assertStatus(200);  // Test if view loading

        $response->assertSee('content'); // Test if it has content
    }

    /**
     * Test Sports edit view response
     */
    public function testSportsEditViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $sport = Sport::first();

        $response = $this->actingAs($user, 'web')
            ->get("/admin/sports/{$sport->id}/edit");

        $response->assertStatus(200);

        $response->assertViewHas('sport'); //

        $responseSport = (object) $response->original['sport']->first();

        if($sport->id==$responseSport->id) {
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

        if($seasons->id==$responseSeasons->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Seasons create view response
     */
    public function testSeasonsCreateViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/seasons/create');

        $response->assertStatus(200);  // Test if view loading

        $response->assertSee('content'); // Test if it has content
    }

    /**
     * Test Seasons edit view response
     */
    public function testSeasonsEditViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $season = Season::first();

        $response = $this->actingAs($user, 'web')
            ->get("/admin/seasons/{$season->id}/edit");

        $response->assertStatus(200);

        $response->assertViewHas('season'); //

        $responseSeason = (object) $response->original['season']->first();

        if($season->id==$responseSeason->id) {
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

        if($championships->id==$responseChampionships->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Seasons create view response
     */
    public function testChampionshipsCreateViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/championships/create');

        $response->assertStatus(200);  // Test if view loading

        $response->assertSee('content'); // Test if it has content
    }

    /**
     * Test Championships edit view response
     */
    public function testChampionshipsEditViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $championship = Championship::first();

        $response = $this->actingAs($user, 'web')
            ->get("/admin/championships/{$championship->id}/edit");

        $response->assertStatus(200);

        $response->assertViewHas('championship');

        $responseChampionship = (object) $response->original['championship']->first();

        if($championship->id==$responseChampionship->id) {
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

        if($matchdays->id === $responseMatchdays->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Matchdays create view response
     */
    public function testMatchdaysCreateViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/matchdays/create');

        $response->assertStatus(200);  // Test if view loading

        $response->assertSee('content'); // Test if it has content
    }

    /**
     * Test Matchdays edit view response
     */
    public function testMatchdaysEditViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $matchday = Matchday::first();

        $response = $this->actingAs($user, 'web')
            ->get("/admin/matchdays/{$matchday->id}/edit");

        $response->assertStatus(200);

        $response->assertViewHas('matchday'); //

        $responseMatchday = (object) $response->original['matchday']->first();

        if($matchday->id==$responseMatchday->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    /**
     * Test Posts Index view response
     */
    public function testPostsIndexViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/posts');

        $response->assertStatus(200);

        $response->assertViewHas('posts');

        $posts = Post::first();

        $responsePosts = (object) $response->original['posts']->first();

        if($posts->id==$responsePosts->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Posts create view response
     */
    public function testPostsCreateViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/posts/create');

        $response->assertStatus(200);  // Test if view loading

        $response->assertSee('content'); // Test if it has content
    }

    /**
     * Test Posts edit view response
     */
    public function testPostsEditViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $post = Post::first();

        $response = $this->actingAs($user, 'web')
            ->get("/admin/posts/{$post->id}/edit");

        $response->assertStatus(200);

        $response->assertViewHas('post'); //

        $responsePost = (object) $response->original['post']->first();

        if($post->id==$responsePost->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    /**
     * Test Comments Index view response
     */
    public function testCommentsIndexViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/comments');

        $response->assertStatus(200);

        $response->assertViewHas('comments');

        $comments = Comment::first();

        $responseComments = (object) $response->original['comments']->first();

        if($comments->id==$responseComments->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Comments edit view response
     */
    public function testCommentsEditViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $comment = Comment::first();

        $response = $this->actingAs($user, 'web')
            ->get("/admin/comments/{$comment->id}/edit");

        $response->assertStatus(200);

        $response->assertViewHas('comment'); //

        $responseComment = (object) $response->original['comment']->first();

        if($comment->id==$responseComment->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    /**
     * Test Users Index view response
     */
    public function testUsersIndexViewResponse()
    {
        $user = User::whereRoleId(1)->first();

        $response = $this->actingAs($user, 'web')
            ->get('/admin/users');

        $response->assertStatus(200);

        $response->assertViewHas('users');

        $responseUsers = (object) $response->original['users']->first();

        if($user->id==$responseUsers->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test Home page index view
     */
    public function testHomeIndex()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertViewHas('sports');

        $responseSports = (object) $response->original['sports']->first();

        $sports = Sport::first();

        if($sports->id==$responseSports->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test public sport index page
     */
    public function testSportIndex()
    {
        $sport = Sport::first();

        $response = $this->get("/sport/{$sport->slug}");

        $response->assertStatus(200);

        $response->assertViewHas('sport');

        $responseSport = (object) $response->original['sport']->first();

        $sport = Sport::first();

        if($sport->id==$responseSport->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    /**
     * Test team posts index view
     */
    public function testTeamPostsIndex()
    {
        // Team with posts relations
        $team = Team::whereHas('posts')->first();

        $response = $this->get("/teamPosts/{$team->slug}");

        $response->assertStatus(200);

        $response->assertViewHas('posts');

        $responsePost = (object) $response->original['posts']->first();

        $post = $team->posts()->orderBy('created_at', 'desc')->first();

        if($post->id==$responsePost->id) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

}
