<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Http\Resources\MatchResource;
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

        if($request->has('_token')) { // If there are request data do filter
            $matches = Match::whereSportId($request->sport_id)->
                whereChampionshipId($request->championship_id)->
                whereSeasonId($request->season_id)->
                whereMatchdayId($request->matchday_id)->
                orderBy('match_date', 'desc')->paginate(15);
        } else {  // get all data
            $matches = Match::paginate(15);
            $request = null;
        }

        $championships = Championship::all();
        $sports = Sport::all();
        $seasons = Season::all();

        return view('admin/matches/index', compact('matches', 'championships', 'sports', 'seasons', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $championships = Championship::orderBy('name', 'asc')->all();
        $sports = Sport::orderBy('name', 'asc')->all();
        $seasons = Season::orderBy('name', 'asc')->all();
        $matchdays = Matchday::orderBy('matchday', 'asc')->all();
        $stadia = Stadium::orderBy('name', 'asc')->all();
        $teams = Team::orderBy('name', 'asc')->all();
        $data = $request;

        return view('admin.matches.create', compact('championships', 'sports', 'seasons', 'matchdays', 'stadia', 'teams', 'data'));
    }


    /**
     * Show the form for creating massive matches
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createMassive(Request $request)
    {
        $championships = Championship::orderBy('name', 'asc')->all();
        $sports = Sport::orderBy('name', 'asc')->all();
        $seasons = Season::orderBy('name', 'asc')->all();
        $matchdays = Matchday::orderBy('matchday', 'asc')->all();
        $stadia = Stadium::orderBy('name', 'asc')->all();
        $teams = Team::whereChampionshipId($request->championship_id)->orderBy('name', 'asc')->get();
        $data = $request;

        return view('admin/matches/createMassive', compact('championships', 'sports', 'seasons', 'matchdays', 'stadia', 'teams', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sport_id' => 'required',
            'championship_id' => 'required',
            'season_id' => 'required',
            'match_date' => 'nullable|date',
            'matchday_id' => 'required',
            'stadium_id' => 'nullable',
            'first_team_id' => 'required',
            'second_team_id' => 'required',
            'first_team_score' => 'nullable|integer|between:0,200',
            'second_team_score' => 'nullable|integer|between:0,200'
        ]);

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
        $validatedData = $request->validate([
            'sport_id' => 'required',
            'championship_id' => 'required',
            'season_id' => 'required',
            'match_date' => 'nullable|date',
            'matchday_id' => 'required',
            'stadium_id' => 'nullable',
            'first_team_id' => 'required',
            'second_team_id' => 'required',
            'first_team_score' => 'nullable|integer|between:0,200',
            'second_team_score' => 'nullable|integer|between:0,200'
        ]);

        $input = $request->all();

        $match = Match::findOrFail($id);

        $match->update($input);

        return redirect(route('matches.index'));
    }

    /**
     * Api call to update score
     *
     * @param Request $request
     * @return MatchResource
     */
    public function updateScore(Request $request)
    {
        $input = $request->all();

        $match = Match::findOrFail($request->id);

        $match->update($input);

        return new MatchResource($match);
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
