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
        // construct $this->teams array with teams and 0 points
        foreach ($teams as $team) {
            $this->teams[] = [
                'team' => $team,
                'points' => 0
            ];
        }

        // Get matches of season
        $this->matches = $matches;

    }

    public function getStandings()
    {
        return $this->teams;
    }


}