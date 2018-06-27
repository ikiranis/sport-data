<?php

namespace Tests\Unit;

use App\src\Standings;
use ReflectionClass;
use Tests\TestCase;

class StandingsTest extends TestCase
{

    private $mainTeams = array();
    private $smallTeamsArray = ['AEK', 'ARIS', 'OLYMPIAKOS'];

    /**
     * get teams array
     *
     * @return array
     */
    public function setMainTeams()
    {
        return [
            'PAOK' => (object)[
                'data' => (object)['name' => 'PAOK']
            ],
            'PAO' => (object)[
                'data' => (object)['name' => 'PAO']
            ],
            'ARIS' => (object)[
                'data' => (object)['name' => 'ARIS']
            ],
            'OLYMPIAKOS' => (object)[
                'data' => (object)['name' => 'OLYMPIAKOS']
            ],
            'AEK' => (object)[
                'data' => (object)['name' => 'AEK']
            ],
            'IRAKLIS' => (object)[
                'data' => (object)['name' => 'IRAKLIS']
            ],
            'EORDAIKOS' => (object)[
                'data' => (object)['name' => 'EORDAIKOS']
            ],
            'KOZANI' => (object)[
                'data' => (object)['name' => 'KOZANI']
            ]
        ];
    }

    /**
     * Some mock teams stats
     *
     * @return array
     */
    public function getTeamStats()
    {
        return [
            'PAOK' => (object)[
                'points' => 7,
                'scoreFor' => 8,
                'scoreAgainst' => 4,
                'scoreDifference' => 4,
                'generalScoreDifference' => 9,
                'generalScoreFor' => 14,
                'generalScoreAgainst' => 5
            ],
            'PAO' => (object)[
                'points' => 7,
                'scoreFor' => 8,
                'scoreAgainst' => 4,
                'scoreDifference' => 4,
                'generalScoreDifference' => 9,
                'generalScoreFor' => 14,
                'generalScoreAgainst' => 5
            ],
            'AEK' => (object)[
                'points' => 7,
                'scoreFor' => 8,
                'scoreAgainst' => 4,
                'scoreDifference' => 4,
                'generalScoreDifference' => 9,
                'generalScoreFor' => 14,
                'generalScoreAgainst' => 5
            ],
            'OLYMPIAKOS' => (object)[
                'points' => 7,
                'scoreFor' => 8,
                'scoreAgainst' => 4,
                'scoreDifference' => 4,
                'generalScoreDifference' => 9,
                'generalScoreFor' => 14,
                'generalScoreAgainst' => 5
            ],
            'KOZANI' => (object)[
                'points' => 7,
                'scoreFor' => 8,
                'scoreAgainst' => 4,
                'scoreDifference' => 4,
                'generalScoreDifference' => 9,
                'generalScoreFor' => 14,
                'generalScoreAgainst' => 5
            ],
            'EORDAIKOS' => (object)[
                'points' => 7,
                'scoreFor' => 8,
                'scoreAgainst' => 4,
                'scoreDifference' => 4,
                'generalScoreDifference' => 9,
                'generalScoreFor' => 14,
                'generalScoreAgainst' => 5
            ]
        ];

    }

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
            [  // 0 football matches
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
            ], // 1
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
            ],
            [ // 2
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'PAO'],
                    'first_team_score' => '5',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAO'],
                    'second_team' => (object)['name' => 'PAOK'],
                    'first_team_score' => '2',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAO'],
                    'second_team' => (object)['name' => 'PAOK'],
                    'first_team_score' => '0',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'PAO'],
                    'first_team_score' => '2',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'ARIS'],
                    'second_team' => (object)['name' => 'OLYMPIAKOS'],
                    'first_team_score' => '3',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'OLYMPIAKOS'],
                    'second_team' => (object)['name' => 'ARIS'],
                    'first_team_score' => '5',
                    'second_team_score' => '3'
                ],
                (object)[
                    'first_team' => (object)['name' => 'AEK'],
                    'second_team' => (object)['name' => 'IRAKLIS'],
                    'first_team_score' => '5',
                    'second_team_score' => '2'
                ],
                (object)[
                    'first_team' => (object)['name' => 'IRAKLIS'],
                    'second_team' => (object)['name' => 'AEK'],
                    'first_team_score' => '6',
                    'second_team_score' => '4'
                ],
                (object)[
                    'first_team' => (object)['name' => 'OLYMPIAKOS'],
                    'second_team' => (object)['name' => 'AEK'],
                    'first_team_score' => '2',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'AEK'],
                    'second_team' => (object)['name' => 'ARIS'],
                    'first_team_score' => '3',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'ARIS'],
                    'second_team' => (object)['name' => 'IRAKLIS'],
                    'first_team_score' => '6',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'IRAKLIS'],
                    'second_team' => (object)['name' => 'OLYMPIAKOS'],
                    'first_team_score' => '1',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'OLYMPIAKOS'],
                    'first_team_score' => '1',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAO'],
                    'second_team' => (object)['name' => 'IRAKLIS'],
                    'first_team_score' => '3',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'AEK'],
                    'first_team_score' => '5',
                    'second_team_score' => '1'
                ]
            ],
            [ // 3 Multiple equal points
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'AEK'],
                    'first_team_score' => '2',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAO'],
                    'second_team' => (object)['name' => 'EORDAIKOS'],
                    'first_team_score' => '4',
                    'second_team_score' => '2'
                ],
                (object)[
                    'first_team' => (object)['name' => 'KOZANI'],
                    'second_team' => (object)['name' => 'OLYMPIAKOS'],
                    'first_team_score' => '0',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'IRAKLIS'],
                    'second_team' => (object)['name' => 'ARIS'],
                    'first_team_score' => '1',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'AEK'],
                    'second_team' => (object)['name' => 'PAO'],
                    'first_team_score' => '3',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'OLYMPIAKOS'],
                    'second_team' => (object)['name' => 'PAOK'],
                    'first_team_score' => '3',
                    'second_team_score' => '3'
                ],
                (object)[
                    'first_team' => (object)['name' => 'EORDAIKOS'],
                    'second_team' => (object)['name' => 'KOZANI'],
                    'first_team_score' => '2',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'ARIS'],
                    'second_team' => (object)['name' => 'IRAKLIS'],
                    'first_team_score' => '2',
                    'second_team_score' => '3'
                ],
                (object)[
                    'first_team' => (object)['name' => 'IRAKLIS'],
                    'second_team' => (object)['name' => 'OLYMPIAKOS'],
                    'first_team_score' => '2',
                    'second_team_score' => '2'
                ],
                (object)[
                    'first_team' => (object)['name' => 'KOZANI'],
                    'second_team' => (object)['name' => 'PAOK'],
                    'first_team_score' => '1',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'EORDAIKOS'],
                    'second_team' => (object)['name' => 'ARIS'],
                    'first_team_score' => '2',
                    'second_team_score' => '4'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAO'],
                    'second_team' => (object)['name' => 'AEK'],
                    'first_team_score' => '3',
                    'second_team_score' => '3'
                ],
                (object)[
                    'first_team' => (object)['name' => 'AEK'],
                    'second_team' => (object)['name' => 'PAOK'],
                    'first_team_score' => '2',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'ARIS'],
                    'second_team' => (object)['name' => 'KOZANI'],
                    'first_team_score' => '0',
                    'second_team_score' => '2'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'PAO'],
                    'first_team_score' => '1',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'IRAKLIS'],
                    'second_team' => (object)['name' => 'EORDAIKOS'],
                    'first_team_score' => '0',
                    'second_team_score' => '5'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAO'],
                    'second_team' => (object)['name' => 'KOZANI'],
                    'first_team_score' => '2',
                    'second_team_score' => '1'
                ],
                (object)[
                    'first_team' => (object)['name' => 'KOZANI'],
                    'second_team' => (object)['name' => 'ARIS'],
                    'first_team_score' => '1',
                    'second_team_score' => '3'
                ],
                (object)[
                    'first_team' => (object)['name' => 'EORDAIKOS'],
                    'second_team' => (object)['name' => 'IRAKLIS'],
                    'first_team_score' => '3',
                    'second_team_score' => '3'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'OLYMPIAKOS'],
                    'first_team_score' => '2',
                    'second_team_score' => '4'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'IRAKLIS'],
                    'first_team_score' => '3',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAO'],
                    'second_team' => (object)['name' => 'AEK'],
                    'first_team_score' => '2',
                    'second_team_score' => '5'
                ],
                (object)[
                    'first_team' => (object)['name' => 'KOZANI'],
                    'second_team' => (object)['name' => 'EORDAIKOS'],
                    'first_team_score' => '0',
                    'second_team_score' => '2'
                ],
                (object)[
                    'first_team' => (object)['name' => 'ARIS'],
                    'second_team' => (object)['name' => 'OLYMPIAKOS'],
                    'first_team_score' => '3',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAO'],
                    'second_team' => (object)['name' => 'ARIS'],
                    'first_team_score' => '1',
                    'second_team_score' => '0'
                ],
                (object)[
                    'first_team' => (object)['name' => 'OLYMPIAKOS'],
                    'second_team' => (object)['name' => 'KOZANI'],
                    'first_team_score' => '2',
                    'second_team_score' => '2'
                ],
                (object)[
                    'first_team' => (object)['name' => 'IRAKLIS'],
                    'second_team' => (object)['name' => 'EORDAIKOS'],
                    'first_team_score' => '3',
                    'second_team_score' => '2'
                ],
                (object)[
                    'first_team' => (object)['name' => 'PAOK'],
                    'second_team' => (object)['name' => 'KOZANI'],
                    'first_team_score' => '2',
                    'second_team_score' => '4'
                ],
                (object)[
                    'first_team' => (object)['name' => 'IRAKLIS'],
                    'second_team' => (object)['name' => 'OLYMPIAKOS'],
                    'first_team_score' => '3',
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
     * test findEqualTeams method
     */
    public function testFindEqualTeams()
    {
        $standings = new Standings();
        $standings->setMatches($this->getMatches()[0]);
        $standings->setRules($this->getRules()[0]);

        $teamsStanding = $standings->getStandings();

        $equalTeams = $standings->findEqualTeams($teamsStanding, 'points');

        $this->assertEquals(['IRAKLIS', 'ARIS', 'PAOK'], $equalTeams[3]);
        $this->assertEquals(['KOZANI', 'EORDAIKOS'], $equalTeams[1]);
        $this->assertEquals(['AEK', 'OLYMPIAKOS', 'PAO'], $equalTeams[0]);

    }

    /**
     * Test sorting teams by general score difference
     */
    public function testSortByGeneralScoreDifference()
    {
        $standings = new Standings();
        $standings->setMatches($this->getMatches()[0]);
        $standings->setRules($this->getRules()[0]);

        $teamsStanding = $standings->getStandings();

        $this->assertEquals(['PAOK', 'ARIS', 'IRAKLIS'], $standings->sortByGeneralScoreDifference($standings->findEqualTeams($teamsStanding, 'points')[3]));
        $this->assertEquals(['EORDAIKOS', 'KOZANI'], $standings->sortByGeneralScoreDifference($standings->findEqualTeams($teamsStanding, 'points')[1]));
        $this->assertEquals(['OLYMPIAKOS', 'AEK', 'PAO'], $standings->sortByGeneralScoreDifference($standings->findEqualTeams($teamsStanding, 'points')[0]));
    }

    /**
     * Test sorting group of teams by matches betwwen them, by $sortField
     */
    public function testSortByGroupTeams()
    {
        $standings = new Standings();
        $standings->setMatches($this->getMatches()[2]);
        $standings->setRules($this->getRules()[0]);

        $teamsStanding = $standings->getStandings();

        $equalTeamsStats = $standings->calculateEqualTeamsStats($standings->findEqualTeams($teamsStanding, 'points')[6]);

        $this->assertEquals(['ARIS', 'AEK', 'OLYMPIAKOS', 'IRAKLIS'], $standings->sortByGroupTeams($equalTeamsStats, 'scoreDifference'));
        $this->assertEquals(['ARIS', 'OLYMPIAKOS', 'AEK', 'IRAKLIS'], $standings->sortByGroupTeams($equalTeamsStats, 'points'));
        $this->assertEquals(['ARIS', 'AEK', 'IRAKLIS', 'OLYMPIAKOS'], $standings->sortByGroupTeams($equalTeamsStats, 'scoreFor'));
        $this->assertEquals(['IRAKLIS', 'ARIS', 'AEK', 'OLYMPIAKOS'], $standings->sortByGroupTeams($equalTeamsStats, 'scoreAgainst'));
    }

    /**
     * Test CalculateEqualTeamsStats method
     */
    public function testCalculateEqualTeamsStats()
    {
        $standings = new Standings();
        $standings->setMatches($this->getMatches()[2]);
        $standings->setRules($this->getRules()[0]);

        $teamsStanding = $standings->getStandings();

        $equalTeams = $standings->findEqualTeams($teamsStanding, 'points')[6];

        $equalTeamsStats = $standings->calculateEqualTeamsStats($equalTeams);

        $this->assertEquals(6, $equalTeamsStats['IRAKLIS']->points);
        $this->assertEquals(6, $equalTeamsStats['AEK']->points);
        $this->assertEquals(6, $equalTeamsStats['OLYMPIAKOS']->points);
        $this->assertEquals(6, $equalTeamsStats['ARIS']->points);
    }

    /**
     * Test getting matches between teams
     */
    public function testGetTeamsMatches()
    {
        $standings = new Standings();
        $standings->setMatches($this->getMatches()[2]);

        $teamsMatches = $standings->getTeamsMatches(['PAOK', 'PAO']);

        $this->assertEquals('PAOK', $teamsMatches[0]->first_team->name);
        $this->assertEquals('PAO', $teamsMatches[0]->second_team->name);
        $this->assertEquals('5', $teamsMatches[0]->first_team_score);
        $this->assertEquals('1', $teamsMatches[0]->second_team_score);
        $this->assertEquals('PAO', $teamsMatches[1]->first_team->name);
        $this->assertEquals('PAOK', $teamsMatches[1]->second_team->name);
        $this->assertEquals('PAO', $teamsMatches[2]->first_team->name);
        $this->assertEquals('PAOK', $teamsMatches[2]->second_team->name);
        $this->assertEquals('PAOK', $teamsMatches[3]->first_team->name);
        $this->assertEquals('PAO', $teamsMatches[3]->second_team->name);

        $teamsMatches = $standings->getTeamsMatches(['ARIS', 'OLYMPIAKOS']);

        $this->assertEquals('ARIS', $teamsMatches[0]->first_team->name);
        $this->assertEquals('OLYMPIAKOS', $teamsMatches[0]->second_team->name);
        $this->assertEquals('3', $teamsMatches[0]->first_team_score);
        $this->assertEquals('1', $teamsMatches[0]->second_team_score);
    }

    /**
     * Test gettting teams couples
     */
    public function testGetTeamsCouples()
    {
        $standings = new Standings();

        $teamsCouples = $standings->getTeamsCouples(['PAOK', 'PAO', 'ARIS', 'OLYMPIAKOS']);

        $this->assertEquals(['PAOK', 'PAO'], $teamsCouples[0]);
        $this->assertEquals(['PAOK', 'ARIS'], $teamsCouples[1]);
        $this->assertEquals(['PAOK', 'OLYMPIAKOS'], $teamsCouples[2]);
        $this->assertEquals(['PAO', 'ARIS'], $teamsCouples[3]);
        $this->assertEquals(['PAO', 'OLYMPIAKOS'], $teamsCouples[4]);
        $this->assertEquals(['ARIS', 'OLYMPIAKOS'], $teamsCouples[5]);
    }

    /**
     * Test getTeamsStats method
     */
    public function testGetTeamsStats()
    {
        $standings = new Standings();
        $standings->setMatches($this->getMatches()[2]);
        $standings->setRules($this->getRules()[0]);

        $teamStandings = $standings->getStandings();

        $teams = ['PAOK', 'PAO'];

        $teamMatches = $standings->getTeamsMatches($teams);

        $teamsStats = $standings->getTeamsStats($teams, $teamMatches);

        $this->assertEquals(7, $teamsStats['PAOK']->points);
        $this->assertEquals(4, $teamsStats['PAO']->points);
        $this->assertEquals(8, $teamsStats['PAOK']->scoreFor);
        $this->assertEquals(14, $teamsStats['PAOK']->generalScoreFor);
        $this->assertEquals(4, $teamsStats['PAO']->scoreFor);
        $this->assertEquals(7, $teamsStats['PAO']->generalScoreFor);
        $this->assertEquals(4, $teamsStats['PAOK']->scoreAgainst);
        $this->assertEquals(5, $teamsStats['PAOK']->generalScoreAgainst);
        $this->assertEquals(8, $teamsStats['PAO']->scoreAgainst);
        $this->assertEquals(9, $teamsStats['PAO']->generalScoreAgainst);
        $this->assertEquals(4, $teamsStats['PAOK']->scoreDifference);
        $this->assertEquals(9, $teamsStats['PAOK']->generalScoreDifference);
        $this->assertEquals(-4, $teamsStats['PAO']->scoreDifference);
        $this->assertEquals(-2, $teamsStats['PAO']->generalScoreDifference);

    }

    /**
     * Test the replacePieceOfArrayWithNewSortedPiece method
     */
    public function testReplacePieceOfArrayWithNewSortedPiece()
    {
        $standings = new Standings();

        $mainTeams = $this->setMainTeams();

        $newSortedArray = $standings->replacePieceOfArrayWithNewSortedPiece($mainTeams, $this->smallTeamsArray);

        $this->assertEquals([
            'PAOK' => (object)[
                'data' => (object)['name' => 'PAOK']
            ],
            'PAO' => (object)[
                'data' => (object)['name' => 'PAO']
            ],
            'AEK' => (object)[
                'data' => (object)['name' => 'AEK']
            ],
            'ARIS' => (object)[
                'data' => (object)['name' => 'ARIS']
            ],
            'OLYMPIAKOS' => (object)[
                'data' => (object)['name' => 'OLYMPIAKOS']
            ],
            'IRAKLIS' => (object)[
                'data' => (object)['name' => 'IRAKLIS']
            ],
            'EORDAIKOS' => (object)[
                'data' => (object)['name' => 'EORDAIKOS']
            ],
            'KOZANI' => (object)[
                'data' => (object)['name' => 'KOZANI']
            ]
        ], $newSortedArray);


    }

    public function testSortEqualGroup()
    {
        $standings = new Standings();
        $standings->setMatches($this->getMatches()[3]);
        $standings->setRules($this->getRules()[0]);

        // Rules to sort
        $standings->setSortRules([
            'points',
            'points',
            'scoreDifference',
            'scoreFor',
            'generalScoreDifference',
            'generalScoreFor',
            'generalScoreAgainst'
        ]);

//        $teams = ['ARIS', 'IRAKLIS', 'OLYMPIAKOS', 'KOZANI', 'EORDAIKOS', 'PAO', 'AEK', 'PAOK'];

        $teamStandings = $standings->getStandings();

        $group = $standings->findEqualTeams($teamStandings, 'points')[10]; // Find the group of equal teams. Array of team names

        $sortedGroup = $standings->sortEqualGroup($group); // Sort the group

        $this->assertEquals(['PAOK', 'AEK', 'PAO', 'EORDAIKOS', 'KOZANI', 'OLYMPIAKOS', 'IRAKLIS', 'ARIS'], $sortedGroup);


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
