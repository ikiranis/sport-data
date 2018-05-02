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
            (object)['name' => 'PAOK'],
            (object)['name' => 'PAO'],
            (object)['name' => 'ARIS'],
            (object)['name' => 'OLYMPIAKOS'],
            (object)['name' => 'AEK'],
            (object)['name' => 'IRAKLIS'],
            (object)['name' => 'EORDAIKOS'],
            (object)['name' => 'KOZANI']
        ];
    }

    /**
     * Rules Data
     *
     * @return array
     */
    public function getRules()
    {
        return [
            (object)[
                'winnerPoints' => 3,
                'loserPoints' => 0,
                'drawPoints' => 1,
            ],
            (object)[
                'winWith2Sets' => 3,
                'loseWith2Sets' => 0,
                'winWith1Set' => 2,
                'loseWith1Set' => 1
            ]
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
            [  // football matches
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'PAO'],
                    'first_team_score' => '5',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'ARIS'],
                    'second_team' => (object)['name' => 'OLYMPIAKOS'],
                    'first_team_score' => '3',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'AEK'],
                    'second_team' => (object)['name' => 'IRAKLIS'],
                    'first_team_score' => '1',
                    'second_team_score' => '3'
                ],
                (object)[
                    'first_team' => (object)['name' => 'EORDAIKOS'],
                    'second_team' => (object)['name' => 'KOZANI'],
                    'first_team_score' => '2',
                    'second_team_score' => '2'
                ]
            ],
            [ // volley matches
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'PAO'],
                    'first_team_score' => '3',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'ARIS'],
                    'second_team' => (object)['name' => 'OLYMPIAKOS'],
                    'first_team_score' => '3',
                    'second_team_score' => '2'
                ],
                (object)[
                    'first_team' => (object)['name' => 'AEK'],
                    'second_team' => (object)['name' => 'IRAKLIS'],
                    'first_team_score' => '2',
                    'second_team_score' => '3'
                ],
                (object)[
                    'first_team' => (object)['name' => 'KOZANI'],
                    'second_team' => (object)['name' => 'EORDAIKOS'],
                    'first_team_score' => '0',
                    'second_team_score' => '3'
                ]
            ]
        ];
    }

    /**
     * Test getStandings method
     */
    public function testGetStandings()
    {
        // Test football matches
        $standings = new Standings();
        $standings->setTeams($this->getTeams());
        $standings->setMatches($this->getMatches()[0]);
        $standings->setRules($this->getRules()[0]);

        $teamsStandings = $standings->getStandings();

        $this->assertEquals(3, $teamsStandings['PAOK']->points);
        $this->assertEquals(0, $teamsStandings['PAO']->points);
        $this->assertEquals(3, $teamsStandings['ARIS']->points);
        $this->assertEquals(0, $teamsStandings['OLYMPIAKOS']->points);
        $this->assertEquals(0, $teamsStandings['AEK']->points);
        $this->assertEquals(3, $teamsStandings['IRAKLIS']->points);
        $this->assertEquals(1, $teamsStandings['EORDAIKOS']->points);
        $this->assertEquals(1, $teamsStandings['KOZANI']->points);

        // Test volley matches
        $standings2 = new Standings();
        $standings2->setTeams($this->getTeams());
        $standings2->setMatches($this->getMatches()[1]);
        $standings2->setRules($this->getRules()[1]);

        $teamsStandings = $standings2->getStandings();

        $this->assertEquals(3, $teamsStandings['PAOK']->points);
        $this->assertEquals(0, $teamsStandings['PAO']->points);
        $this->assertEquals(2, $teamsStandings['ARIS']->points);
        $this->assertEquals(1, $teamsStandings['OLYMPIAKOS']->points);
        $this->assertEquals(1, $teamsStandings['AEK']->points);
        $this->assertEquals(2, $teamsStandings['IRAKLIS']->points);
        $this->assertEquals(3, $teamsStandings['EORDAIKOS']->points);
        $this->assertEquals(0, $teamsStandings['KOZANI']->points);
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
