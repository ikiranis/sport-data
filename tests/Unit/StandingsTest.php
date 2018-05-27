<?php

namespace Tests\Unit;

use App\src\Standings;
use ReflectionClass;
use Tests\TestCase;

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
            (object)[ // Football rules
                'winnerPoints' => 3,
                'loserPoints' => 0,
                'drawPoints' => 1,
            ],
            (object)[ // Volley rules
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
        $standings->setMatches($this->getMatches()[0]);
        $standings->setRules($this->getRules()[0]);

        $teamsStandings = $standings->getStandings();

        $this->assertEquals(1, $teamsStandings['PAOK']->matches);
        $this->assertEquals(3, $teamsStandings['PAOK']->points);
        $this->assertEquals(3, $teamsStandings['PAOK']->pointsIn);
        $this->assertEquals(0, $teamsStandings['PAOK']->pointsOut);
        $this->assertEquals(1, $teamsStandings['PAOK']->matches);
        $this->assertEquals(1, $teamsStandings['PAOK']->wins);
        $this->assertEquals(0, $teamsStandings['PAOK']->loses);
        $this->assertEquals(0, $teamsStandings['PAOK']->draws);
        $this->assertEquals(5, $teamsStandings['PAOK']->scoreFor);
        $this->assertEquals(1, $teamsStandings['PAOK']->scoreAgainst);
        $this->assertEquals(5, $teamsStandings['PAOK']->scoreForIn);
        $this->assertEquals(1, $teamsStandings['PAOK']->scoreAgainstIn);
        $this->assertEquals(0, $teamsStandings['PAOK']->scoreForOut);
        $this->assertEquals(0, $teamsStandings['PAOK']->scoreAgainstOut);

        $this->assertEquals(1, $teamsStandings['PAO']->matches);
        $this->assertEquals(0, $teamsStandings['PAO']->points);
        $this->assertEquals(0, $teamsStandings['PAO']->pointsIn);
        $this->assertEquals(0, $teamsStandings['PAO']->pointsOut);
        $this->assertEquals(0, $teamsStandings['PAO']->wins);
        $this->assertEquals(1, $teamsStandings['PAO']->loses);
        $this->assertEquals(0, $teamsStandings['PAO']->draws);
        $this->assertEquals(1, $teamsStandings['PAO']->scoreFor);
        $this->assertEquals(5, $teamsStandings['PAO']->scoreAgainst);
        $this->assertEquals(0, $teamsStandings['PAO']->scoreForIn);
        $this->assertEquals(0, $teamsStandings['PAO']->scoreAgainstIn);
        $this->assertEquals(1, $teamsStandings['PAO']->scoreForOut);
        $this->assertEquals(5, $teamsStandings['PAO']->scoreAgainstOut);

        $this->assertEquals(1, $teamsStandings['ARIS']->matches);
        $this->assertEquals(3, $teamsStandings['ARIS']->points);
        $this->assertEquals(1, $teamsStandings['ARIS']->wins);
        $this->assertEquals(0, $teamsStandings['ARIS']->loses);
        $this->assertEquals(0, $teamsStandings['ARIS']->draws);
        $this->assertEquals(3, $teamsStandings['ARIS']->scoreFor);
        $this->assertEquals(1, $teamsStandings['ARIS']->scoreAgainst);

        $this->assertEquals(1, $teamsStandings['OLYMPIAKOS']->matches);
        $this->assertEquals(0, $teamsStandings['OLYMPIAKOS']->points);
        $this->assertEquals(0, $teamsStandings['OLYMPIAKOS']->wins);
        $this->assertEquals(1, $teamsStandings['OLYMPIAKOS']->loses);
        $this->assertEquals(0, $teamsStandings['OLYMPIAKOS']->draws);
        $this->assertEquals(1, $teamsStandings['OLYMPIAKOS']->scoreFor);
        $this->assertEquals(3, $teamsStandings['OLYMPIAKOS']->scoreAgainst);


        $this->assertEquals(1, $teamsStandings['AEK']->matches);
        $this->assertEquals(0, $teamsStandings['AEK']->points);
        $this->assertEquals(0, $teamsStandings['AEK']->wins);
        $this->assertEquals(1, $teamsStandings['AEK']->loses);
        $this->assertEquals(0, $teamsStandings['AEK']->draws);
        $this->assertEquals(1, $teamsStandings['AEK']->scoreFor);
        $this->assertEquals(3, $teamsStandings['AEK']->scoreAgainst);

        $this->assertEquals(1, $teamsStandings['IRAKLIS']->matches);
        $this->assertEquals(3, $teamsStandings['IRAKLIS']->points);
        $this->assertEquals(1, $teamsStandings['IRAKLIS']->wins);
        $this->assertEquals(0, $teamsStandings['IRAKLIS']->loses);
        $this->assertEquals(0, $teamsStandings['IRAKLIS']->draws);
        $this->assertEquals(3, $teamsStandings['IRAKLIS']->scoreFor);
        $this->assertEquals(1, $teamsStandings['IRAKLIS']->scoreAgainst);

        $this->assertEquals(1, $teamsStandings['EORDAIKOS']->matches);
        $this->assertEquals(1, $teamsStandings['EORDAIKOS']->points);
        $this->assertEquals(1, $teamsStandings['EORDAIKOS']->pointsIn);
        $this->assertEquals(0, $teamsStandings['EORDAIKOS']->pointsOut);
        $this->assertEquals(0, $teamsStandings['EORDAIKOS']->wins);
        $this->assertEquals(0, $teamsStandings['EORDAIKOS']->loses);
        $this->assertEquals(1, $teamsStandings['EORDAIKOS']->draws);
        $this->assertEquals(2, $teamsStandings['EORDAIKOS']->scoreFor);
        $this->assertEquals(2, $teamsStandings['EORDAIKOS']->scoreAgainst);

        $this->assertEquals(1, $teamsStandings['KOZANI']->matches);
        $this->assertEquals(1, $teamsStandings['KOZANI']->points);
        $this->assertEquals(0, $teamsStandings['KOZANI']->pointsIn);
        $this->assertEquals(1, $teamsStandings['KOZANI']->pointsOut);
        $this->assertEquals(0, $teamsStandings['KOZANI']->wins);
        $this->assertEquals(0, $teamsStandings['KOZANI']->loses);
        $this->assertEquals(1, $teamsStandings['KOZANI']->draws);
        $this->assertEquals(2, $teamsStandings['KOZANI']->scoreFor);
        $this->assertEquals(2, $teamsStandings['KOZANI']->scoreAgainst);

        // Test volley matches
        $standings2 = new Standings();
        $standings2->setMatches($this->getMatches()[1]);
        $standings2->setRules($this->getRules()[1]);

        $teamsStandings = $standings2->getStandings();

//        dd($teamsStandings);

        $this->assertEquals(1, $teamsStandings['PAOK']->matches);
        $this->assertEquals(3, $teamsStandings['PAOK']->points);
        $this->assertEquals(1, $teamsStandings['PAO']->matches);
        $this->assertEquals(0, $teamsStandings['PAO']->points);
        $this->assertEquals(1, $teamsStandings['ARIS']->matches);
        $this->assertEquals(2, $teamsStandings['ARIS']->points);
        $this->assertEquals(2, $teamsStandings['ARIS']->pointsIn);
        $this->assertEquals(0, $teamsStandings['ARIS']->pointsOut);
        $this->assertEquals(1, $teamsStandings['OLYMPIAKOS']->matches);
        $this->assertEquals(1, $teamsStandings['OLYMPIAKOS']->points);
        $this->assertEquals(0, $teamsStandings['OLYMPIAKOS']->pointsIn);
        $this->assertEquals(1, $teamsStandings['OLYMPIAKOS']->pointsOut);
        $this->assertEquals(1, $teamsStandings['AEK']->matches);
        $this->assertEquals(1, $teamsStandings['AEK']->points);
        $this->assertEquals(1, $teamsStandings['AEK']->pointsIn);
        $this->assertEquals(0, $teamsStandings['AEK']->pointsOut);
        $this->assertEquals(1, $teamsStandings['IRAKLIS']->matches);
        $this->assertEquals(2, $teamsStandings['IRAKLIS']->points);
        $this->assertEquals(0, $teamsStandings['IRAKLIS']->pointsIn);
        $this->assertEquals(2, $teamsStandings['IRAKLIS']->pointsOut);
        $this->assertEquals(1, $teamsStandings['EORDAIKOS']->matches);
        $this->assertEquals(3, $teamsStandings['EORDAIKOS']->points);
        $this->assertEquals(0, $teamsStandings['EORDAIKOS']->pointsIn);
        $this->assertEquals(3, $teamsStandings['EORDAIKOS']->pointsOut);
        $this->assertEquals(1, $teamsStandings['KOZANI']->matches);
        $this->assertEquals(0, $teamsStandings['KOZANI']->points);
        $this->assertEquals(0, $teamsStandings['KOZANI']->pointsIn);
        $this->assertEquals(0, $teamsStandings['KOZANI']->pointsOut);
    }

    /**
     * Test Championship teams generator
     */
    public function testSetTeams()
    {
        $standings = new Standings();
        $standings->setMatches($this->getMatches()[0]);
        $standings->getChampionshipTeamsFromMatches();

        $teams = $standings->getChampionshipTeams();

        $this->assertEquals('PAOK', $teams[0]->name);
        $this->assertEquals('PAO', $teams[1]->name);
        $this->assertEquals('ARIS', $teams[2]->name);
        $this->assertEquals('OLYMPIAKOS', $teams[3]->name);
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
