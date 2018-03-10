<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Match;
use App\Matchday;
use App\Season;
use App\Sport;
use App\Stadium;
use App\Team;
use Illuminate\Http\Request;

class AdminMatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if(isset($request)) {
            $matches = Match::whereSportId($request->sport_id)->
                whereChampionshipId($request->championship_id)->
                whereSeasonId($request->season_id)->
                paginate(15);
        } else {
            $matches = Match::paginate(15);
        }

        $championships = Championship::all();
        $sports = Sport::all();
        $seasons = Season::all();

        return view('admin/matches/index', compact('matches', 'championships', 'sports', 'seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $championships = Championship::all();
        $sports = Sport::all();
        $seasons = Season::all();
        $matchdays = Matchday::all();
        $stadia = Stadium::all();
        $teams = Team::all();

        return view('admin.matches.create', compact('championships', 'sports', 'seasons', 'matchdays', 'stadia', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Match::create($input);

        return redirect(route('matches.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $match = Match::findOrFail($id);

        $championships = Championship::all();
        $sports = Sport::all();
        $seasons = Season::all();
        $matchdays = Matchday::all();
        $stadia = Stadium::all();
        $teams = Team::all();

        return view('admin.matches.edit', compact('match', 'championships', 'sports', 'seasons', 'matchdays', 'stadia', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $match = Match::findOrFail($id);

        $match->update($input);

        return redirect(route('matches.index'));
    }

    public function updateScore(Request $request)
    {
        $input = $request->all();

        $match = Match::findOrFail($request->id);

        $match->update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
