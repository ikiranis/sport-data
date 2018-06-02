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
    private $championshipTeams = array();
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
     * Teams getter
     *
     * @return array
     */
    public function getChampionshipTeams()
    {
        return $this->championshipTeams;
    }

    /**
     * Teams generator from matches
     */
    public function getChampionshipTeamsFromMatches()
    {
        foreach ($this->matches as $match) {
            $teams = [$match->first_team, $match->second_team];

            foreach ($teams as $team) {
                if (!in_array($team->name, $this->championshipTeams)) {
                    $this->championshipTeams[] = $team;
                }
            }
        }
    }


    /**
     * Teams setter
     *
     */
    public function setTeams()
    {
        // construct $this->teams array of objects, with names and 0 points
        foreach ($this->championshipTeams as $team) {
            $this->teams[$team->name] = (object)[
                'data' => $team,
                'matches' => 0,
                'wins' => 0,
                'draws' => 0,
                'loses' => 0,
                'scoreFor' => 0,
                'scoreAgainst' => 0,
                'scoreForIn' => 0,
                'scoreAgainstIn' => 0,
                'scoreForOut' => 0,
                'scoreAgainstOut' => 0,
                'points' => 0,
                'pointsIn' => 0,
                'pointsOut' => 0
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
    private function setTeamPoints($teams, $points, $winner)
    {
        // Calculate points in/out
        switch ($winner) {
            case '1':  // for home team
                $this->teams[$teams[0]]->pointsIn += $points[0];
                $this->teams[$teams[1]]->pointsOut += $points[1];
                break;
            case '2':  // for away team
                $this->teams[$teams[1]]->pointsIn += $points[1];
                $this->teams[$teams[0]]->pointsOut += $points[0];
                break;
            case 'X':  // for draw
                $this->teams[$teams[0]]->pointsIn += $points[0];
                $this->teams[$teams[1]]->pointsOut += $points[1];
                break;
        }

        foreach ($teams as $key => $team) {
            $this->teams[$team]->points += $points[$key];

            $this->teams[$team]->matches++;

            if ($points[0] !== $points[1]) {
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
            case 'win':
                $this->teams[$team]->wins++;
                break;
            case 'lose':
                $this->teams[$team]->loses++;
                break;
            case 'draw':
                $this->teams[$team]->draws++;
                break;
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

        if ($scoreDifference > 0) { // First team wins
            $this->setTeamPoints($firstTeamWinsTeams, $pointsByTheWinner, '1');
        } elseif ($scoreDifference < 0) { // Second team wins
            $this->setTeamPoints($secondTeamWinsTeams, $pointsByTheWinner, '2');
        } else { // Draw
            $this->setTeamPoints($firstTeamWinsTeams, $drawPoints, 'X');
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

        if ($scoreDifference > 0) { // First team wins
            if ($scoreDifference > 1) { // Score bigger than 1 set difference
                $this->setTeamPoints($firstTeamWinsTeams, $pointsByScoreDifferenceWith2Sets, '1');
            } else { // Score with 1 set difference
                $this->setTeamPoints($firstTeamWinsTeams, $pointsByScoreDifferenceWith1Set, '1');
            }
        } else { // Second team wins
            if ($scoreDifference < -1) { // Score bigger than 1 set difference
                $this->setTeamPoints($secondTeamWinsTeams, $pointsByScoreDifferenceWith2Sets, '2');
            } else { // Score with 1 set difference
                $this->setTeamPoints($secondTeamWinsTeams, $pointsByScoreDifferenceWith1Set, '2');
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
        foreach ($teams as $key => $team) {
            $otherKey = ($key == 0) ? 1 : 0;

            $this->teams[$team]->scoreFor += $score[$key];
            $this->teams[$team]->scoreAgainst += $score[$otherKey];

            if ($key == 0) {
                $this->teams[$team]->scoreForIn += $score[$key];
                $this->teams[$team]->scoreAgainstIn += $score[$otherKey];
            } else {
                $this->teams[$team]->scoreForOut += $score[$key];
                $this->teams[$team]->scoreAgainstOut += $score[$otherKey];
            }
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
        if (isset($match->first_team_score) && isset($match->second_team_score)) {

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
        $this->getChampionshipTeamsFromMatches(); // Generate teams from matches
        $this->setTeams();  // Set Teams with data fields

        foreach ($this->matches as $match) {
            $this->setTeamsPoints($match);
        }

        $this->sortStandings();
    }

    /**
     * Sort array $this->team
     */
    private function sortStandings()
    {
        $this->teams = array_reverse(array_sort($this->teams, 'points'));
//        $equalTeams = $this->findEqualTeams();
    }

    /**
     * Sort teams by general score difference
     *
     * @param $equalTeams
     * @return array
     */
    public function sortByGeneralScoreDifference($equalTeams)
    {
        $sortTeams = array();

        foreach ($equalTeams as $equalTeam) {
            $scoreDifference = $this->teams[$equalTeam]->scoreFor - $this->teams[$equalTeam]->scoreAgainst;
            $sortTeams[$equalTeam] = $scoreDifference;
        }

        $sortTeams = array_reverse(array_sort($sortTeams));

        return array_keys($sortTeams);
    }

    /**
     * Get matches between teams
     *
     * @param $team1
     * @param $team2
     * @return array
     */
    public function getTeamsMatches($teams)
    {
        $matches = array();

        foreach ($this->matches as $match) {
            $firstTeam = $match->first_team->name;
            $secondTeam = $match->second_team->name;

            if( ($firstTeam == $teams[0] || $firstTeam == $teams[1]) || ($secondTeam == $teams[0] || $secondTeam == $teams[1]) ) {
                $matches[] = $match;
            }
        }

        return $matches;

    }

    /**
     * Get teams couples
     *
     * @param $teams
     * @return array
     */
    public function getTeamsCouples($teams)
    {
        $couples = array();

        foreach ($teams as $key=>$team) {
            $firstTeam = $team;

            for($i=$key+1; $i<sizeof($teams); $i++) {
                $couples[] = [$firstTeam, $teams[$i]];
            }
        }

        return $couples;
    }

    public function sortByScoreDifferenceBetweenTeams($equalTeams)
    {

        $sortTeams = array();

        $teamsCouples = $this->getTeamsCouples($equalTeams);

        foreach ($teamsCouples as $couple) {
            $teamsMatches = $this->getTeamsMatches($couple);
        }

        foreach ($equalTeams as $equalTeam) {
            $scoreDifference = $this->teams[$equalTeam]->scoreFor - $this->teams[$equalTeam]->scoreAgainst;
            $sortTeams[$equalTeam] = $scoreDifference;
        }

        $sortTeams = array_reverse(array_sort($sortTeams));

//        return array_keys($sortTeams);

        return ['PAOK', 'ARIS', 'IRAKLIS'];
    }

    /**
     * Find equal teams with same points
     *
     * @return array
     */
    public function findEqualTeams()
    {
        $equalTeams = array();

        foreach ($this->teams as $team) {
            $equalTeams[$team->points][] = $team->data->name;
        }

        return $equalTeams;
    }

    /**
     * Get overall standings
     *
     * @return Collection
     */
    public function getStandings()
    {
        $this->compute();

        return collect($this->teams)->all();
    }


}