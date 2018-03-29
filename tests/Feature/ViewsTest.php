<?php

namespace Tests\Feature;

use App\Athlete;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewsTest extends TestCase
{

    /**
     * Test Atletes Index view response
     */
    public function testAthletesIndexResponse()
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
            dd($responseAthlete);
            $this->assertTrue(false);
        }

    }

}
