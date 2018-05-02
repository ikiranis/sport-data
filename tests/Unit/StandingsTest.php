<?php

namespace Tests\Unit;

use App\src\Standings;
use ReflectionClass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StandingsTest extends TestCase
{

    /**
     * Teams Data
     *
     * @return array
     */
    public function getTeams()
    {
        return [
            (object) ['name' => 'PAOK'],
            (object) ['name' => 'PAO'],
            (object) ['name' => 'ARIS'],
            (object) ['name' => 'OLYMPIAKOS'],
            (object) ['name' => 'AEK'],
            (object) ['name' => 'IRAKLIS'],
            (object) ['name' => 'EORDAIKOS'],
            (object) ['name' => 'KOZANI']
        ];
    }

    /**
     * Rules Data
     *
     * @return object
     */
    public function getRules()
    {
        return (object) [
            'winnerPoints' => 3,
            'loserPoints' => 0,
            'drawPoints' => 1,
        ];
    }

    /**
     * Matches data
     *
     * @return array
     */
    public function getMatches()
    {
        return [
            (object) [
                'first_team' => (object) ['name' => 'PAOK'],
                'second_team' => (object) ['name' => 'PAO'],
                'first_team_score' => '5',
                'second_team_score' => '1'
            ],
            (object) [
                'first_team' => (object) ['name' => 'ARIS'],
                'second_team' => (object) ['name' => 'OLYMPIAKOS'],
                'first_team_score' => '3',
                'second_team_score' => '1'
            ],
            (object) [
                'first_team' => (object) ['name' => 'AEK'],
                'second_team' => (object) ['name' => 'IRAKLIS'],
                'first_team_score' => '1',
                'second_team_score' => '3'
            ],
            (object) [
                'first_team' => (object) ['name' => 'EORDAIKOS'],
                'second_team' => (object) ['name' => 'KOZANI'],
                'first_team_score' => '2',
                'second_team_score' => '2'
            ]
        ];
    }

    /**
     * Test getStandings method
     */
    public function testGetStandings()
    {
        $standings = new Standings();
        $standings->setTeams($this->getTeams());
        $standings->setMatches($this->getMatches());
        $standings->setRules($this->getRules());

        $teamsStandings = $standings->getStandings();

        $this->assertEquals(3, $teamsStandings['PAOK']->points);
        $this->assertEquals(1, $teamsStandings['EORDAIKOS']->points);
        $this->assertEquals(0, $teamsStandings['AEK']->points);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     * @throws \ReflectionException
     */
    public function invokeMethod(&$object, $methodName, array $parameters)
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }



}
