<?php
/**
 *
 * File: computeStandings.php
 *
 * Created by Yiannis Kiranis <rocean74@gmail.com>
 * http://www.apps4net.eu
 *
 * Date: 24/04/2018
 * Time: 23:28
 *
 */

namespace App\src;


use Illuminate\Support\Collection;

class Standings
{
    private $teams = array();
    private $matches = array();
    private $winPoints;
    private $losePoints;
    private $drawPoints;

    /**
     * Standings constructor
     */
    public function __construct()
    {
        $this->setPoints();
    }

    /**
     * Teams setter
     *
     * @param array $teams
     */
    public function setTeams($teams)
    {
        // construct $this->teams array of objects, with names and 0 points
        foreach ($teams as $team) {
            $this->teams[$team->name] = (object) [
                'points' => 0
            ];
        }
    }

    /**
     * Matches setter
     *
     * @param array $matches
     */
    public function setMatches($matches)
    {
        $this->matches = $matches;
    }

    /**
     * Set points for winner/loser/draw
     */
    private function setPoints()
    {
        $this->winPoints = 3;
        $this->losePoints = 0;
        $this->drawPoints = 1;
    }

    /**
     * Finds who is the winner
     *
     * @param $firstTeamScore
     * @param $secondTeamScore
     * @return string
     */
    private function whoIsTheWinner($firstTeamScore, $secondTeamScore)
    {
        if($firstTeamScore > $secondTeamScore) {
            return '1';
        } elseif ($firstTeamScore < $secondTeamScore) {
            return '2';
        } else {
            return 'X';
        }
    }

    /**
     * Set points for team
     *
     * @param $team
     * @param $points
     */
    private function setTeamPoints($team, $points)
    {
        $this->teams[$team]->points += $points;
    }

    /**
     * Set the points for every team in match
     *
     * @param $firstTeam
     * @param $secondTeam
     * @param $winner
     */
    private function setTeamsPoints($match, $winner)
    {
        if($winner == '1') {
            $this->setTeamPoints($match->first_team->name, $this->winPoints);
            $this->setTeamPoints($match->second_team->name, $this->losePoints);
        } elseif ($winner == '2') {
            $this->setTeamPoints($match->first_team->name, $this->losePoints);
            $this->setTeamPoints($match->second_team->name, $this->winPoints);
        } else {
            $this->setTeamPoints($match->first_team->name, $this->drawPoints);
            $this->setTeamPoints($match->second_team->name, $this->drawPoints);
        }
    }

    /**
     * Compute overall standings by match scores
     */
    private function compute()
    {
        foreach ($this->matches as $match) {
            $winner = $this->whoIsTheWinner($match->first_team_score, $match->second_team_score);

            $this->setTeamsPoints($match, $winner);
        }
    }

    /**
     * Get overall standings
     *
     * @return Collection
     */
    public function getStandings()
    {
        $this->compute();

        return collect($this->teams)->sortBy('points')->reverse()->all();
    }


}