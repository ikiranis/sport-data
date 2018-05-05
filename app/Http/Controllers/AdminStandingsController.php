<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Match;
use App\Season;
use App\Sport;
use App\src\Standings;
use App\Team;
use Auth;
use Illuminate\Http\Request;

class AdminStandingsController extends Controller
{

    /**
     * Display a listing
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Standings $standings)
    {

        if ($request->has('_token')) { // If there are request data do filter
            $standings->setMatches(
                Match::whereSportId($request->sport_id)->
                whereChampionshipId($request->championship_id)->
                whereSeasonId($request->season_id)->
                orderBy('match_date', 'desc')->get()
            );

            $standings->setTeams(
                Team::whereSportId($request->sport_id)->
                whereChampionshipId($request->championship_id)->get()
            );

            // Pass rules as object
            $rules = json_decode(
                        Championship::whereId($request->championship_id)->
                        firstOrFail()->
                        rule->
                        description,
                    false);
            $standings->setRules($rules);

            $teamsStandings = $standings->getStandings();

        } else {
            $matches = null;
            $teamsStandings = null;
            $request = null;
        }

        $championships = Championship::all();
        $sports = Sport::all();
        $seasons = Season::all();

        return view('admin/standings/index', compact('teamsStandings', 'championships', 'sports', 'seasons', 'request'));
    }

}
