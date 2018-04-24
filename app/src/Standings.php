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


class Standings
{
    private $teams = array();
    private $matches = array();
    private $winPoints = 3;
    private $losePoints = 0;
    private $drawPoints = 1;

    /**
     * Standings constructor
     *
     * @param $matches
     * @param $teams
     */
    public function __construct($matches, $teams)
    {
        // construct $this->teams array of objects, with names and 0 points
        foreach ($teams as $team) {
            $this->teams[$team->name] = (object) [
                'points' => 0
            ];
        }

        // Get matches of season
        $this->matches = $matches;

    }

    /**
     * Compute overall standings by match scores
     */
    private function compute()
    {
        foreach ($this->matches as $match) {
            if($match->first_team_score > $match->second_team_score) {
                $this->teams[$match->first_team->name]->points += $this->winPoints;
                $this->teams[$match->second_team->name]->points += $this->losePoints;
            } elseif ($match->first_team_scrore < $match->second_team_scrore) {
                $this->teams[$match->first_team->name]->points += $this->winPoints;
                $this->teams[$match->second_team->name]->points += $this->losePoints;
            } else {
                $this->teams[$match->first_team->name]->points += $this->drawPoints;
                $this->teams[$match->second_team->name]->points += $this->drawPoints;
            }
        }
    }

    /**
     * Get overall standings
     *
     * @return array
     */
    public function getStandings()
    {
        $this->compute();

        return collect($this->teams)->sortBy('points')->reverse()->all();
    }


}