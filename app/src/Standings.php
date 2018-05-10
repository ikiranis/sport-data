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
                'data' => $team,
                'matches' => 0,
                'wins' => 0,
                'draws' => 0,
                'loses' => 0,
                'scoreFor' => 0,
                'scoreAgainst' => 0,
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
     * Set points for the two teams
     *
     * @param $firstTeam
     * @param $secondTeam
     * @param $firstTeamPoints
     * @param $secondTeamPoints
     */
    private function setTeamPoints($teams, $points)
    {
        foreach ($teams as $key=>$team) {
            $this->teams[$team]->points += $points[$key];
            $this->teams[$team]->matches ++;

            if($points[0] !== $points[1]) {
                switch ($key) {
                    case 0;
                        $this->setTeamResult($team, 'win');
                        break;
                    case 1;
                        $this->setTeamResult($team, 'lose');
                        break;
                }
            } else {
                $this->setTeamResult($team, 'draw');
            }
        }
    }

    /**
     * Set team result (wins, loses, draws)
     *
     * @param $team
     * @param $result
     */
    private function setTeamResult($team, $result)
    {
        switch ($result) {
            case 'win': $this->teams[$team]->wins ++; break;
            case 'lose': $this->teams[$team]->loses ++; break;
            case 'draw': $this->teams[$team]->draws ++; break;
        }

    }

    /**
     * Get the score difference between 2 teams
     *
     * @param $firstTeamScore
     * @param $secondTeamScore
     * @return mixed
     */
    private function getScoreDifference($firstTeamScore, $secondTeamScore)
    {
        return $firstTeamScore - $secondTeamScore;
    }

    /**
     * Set teams points by winner
     *
     * @param $firstTeamWinsTeams
     * @param $secondTeamWinsTeams
     * @param $scoreDifference
     */
    private function setPointsByWinner($firstTeamWinsTeams, $secondTeamWinsTeams, $scoreDifference)
    {
        // Array with points for every team
        $pointsByTheWinner = [$this->rules->winnerPoints, $this->rules->loserPoints];
        $drawPoints = [$this->rules->drawPoints, $this->rules->drawPoints];

        if($scoreDifference > 0) { // First team wins
            $this->setTeamPoints($firstTeamWinsTeams, $pointsByTheWinner);
        } elseif($scoreDifference < 0) { // Second team wins
            $this->setTeamPoints($secondTeamWinsTeams, $pointsByTheWinner);
        } else { // Draw
            $this->setTeamPoints($firstTeamWinsTeams, $drawPoints);
        }
    }

    /**
     * Set teams points by score
     *
     * @param $firstTeamWinsTeams
     * @param $secondTeamWinsTeams
     * @param $scoreDifference
     */
    private function setPointsByScore($firstTeamWinsTeams, $secondTeamWinsTeams, $scoreDifference)
    {
        // Array with points for every team
        $pointsByScoreDifferenceWith2Sets = [$this->rules->winWith2Sets, $this->rules->loseWith2Sets];
        $pointsByScoreDifferenceWith1Set = [$this->rules->winWith1Set, $this->rules->loseWith1Set];

        if($scoreDifference > 0) { // First team wins
            if ($scoreDifference > 1) { // Score bigger than 1 set difference
                $this->setTeamPoints($firstTeamWinsTeams, $pointsByScoreDifferenceWith2Sets);
            } else { // Score with 1 set difference
                $this->setTeamPoints($firstTeamWinsTeams, $pointsByScoreDifferenceWith1Set);
            }
        } else { // Second team wins
            if ($scoreDifference < -1) { // Score bigger than 1 set difference
                $this->setTeamPoints($secondTeamWinsTeams, $pointsByScoreDifferenceWith2Sets);
            } else { // Score with 1 set difference
                $this->setTeamPoints($secondTeamWinsTeams, $pointsByScoreDifferenceWith1Set);
            }
        }
    }

    /**
     * Set score every match team
     *
     * @param $teams
     * @param $score
     */
    private function setTeamsScore($teams, $score)
    {
        foreach ($teams as $key=>$team) {
            $otherKey = ($key==0) ? 1 : 0;

            $this->teams[$team]->scoreFor += $score[$key];
            $this->teams[$team]->scoreAgainst += $score[$otherKey];
        }
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
        // Check if there is a score on match
        if(!$match->first_team_score == null && !$match->second_team_score == null) {

            $scoreDifference = $this->getScoreDifference($match->first_team_score, $match->second_team_score);

            // Array with teams, depends on who wins
            $firstTeamWinsTeams = [$match->first_team->name, $match->second_team->name];
            $secondTeamWinsTeams = [$match->second_team->name, $match->first_team->name];

            $this->setTeamsScore($firstTeamWinsTeams, [$match->first_team_score, $match->second_team_score]);

            if (isset($this->rules->winnerPoints)) { // Points by winner
                $this->setPointsByWinner($firstTeamWinsTeams, $secondTeamWinsTeams, $scoreDifference);
            } elseif (isset($this->rules->winWith1Set)) {  // Points by score difference
                $this->setPointsByScore($firstTeamWinsTeams, $secondTeamWinsTeams, $scoreDifference);
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