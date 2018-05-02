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
    private $rules;

    /**
     * Standings constructor
     */
    public function __construct()
    {
        //
    }

    /**
     * Rules setter
     *
     * @param array $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
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
     * Set points for team
     *
     * @param $team
     * @param $points
     */
    private function setTeamPoints($team, $points)
    {
        $this->teams[$team]->points += $points;
    }

    private function getScoreDifference($firstTeamScore, $secondTeamScore)
    {
        return $firstTeamScore - $secondTeamScore;
    }

    /**
     * Set the points for every team in match
     *
     * @param $firstTeam
     * @param $secondTeam
     * @param $winner
     */
    private function setTeamsPoints($match)
    {

        $scoreDifference = $this->getScoreDifference($match->first_team_score, $match->second_team_score);

        if(isset($this->rules->winnerPoints)) { // Points by winner

            echo $scoreDifference . ': ' . $this->rules->winnerPoints . '     ';

            if($scoreDifference > 0) { // First team wins
                $this->setTeamPoints($match->first_team->name, $this->rules->winnerPoints);
                $this->setTeamPoints($match->second_team->name, $this->rules->loserPoints);
            } elseif($scoreDifference < 0) { // Second team wins
                $this->setTeamPoints($match->second_team->name, $this->rules->winnerPoints);
                $this->setTeamPoints($match->first_team->name, $this->rules->loserPoints);
            } else { // Draw
                $this->setTeamPoints($match->first_team->name, $this->rules->drawPoints);
                $this->setTeamPoints($match->second_team->name, $this->rules->drawPoints);
            }
        } elseif(isset($this->rules->winWith1Set)) {  // Points by score difference
            if($scoreDifference > 0) { // First team wins
                if ($scoreDifference > 1) { // Score bigger than 1 set difference
                    $this->setTeamPoints($match->first_team->name, $this->rules->winWith2Sets);
                    $this->setTeamPoints($match->second_team->name, $this->rules->loseWith2Sets);
                } else { // Score with 1 set difference
                    $this->setTeamPoints($match->first_team->name, $this->rules->winWith1Set);
                    $this->setTeamPoints($match->second_team->name, $this->rules->loseWith1Set);
                }
            } else { // Second team wins
                if ($scoreDifference < -1) { // Score bigger than 1 set difference
                    $this->setTeamPoints($match->second_team->name, $this->rules->winWith2Sets);
                    $this->setTeamPoints($match->first_team->name, $this->rules->loseWith2Sets);
                } else { // Score with 1 set difference
                    $this->setTeamPoints($match->second_team->name, $this->rules->winWith1Set);
                    $this->setTeamPoints($match->first_team->name, $this->rules->loseWith1Set);
                }
            }
        }
    }

    /**
     * Compute overall standings by match scores
     */
    private function compute()
    {
        foreach ($this->matches as $match) {
            $this->setTeamsPoints($match);
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