<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatchdayResource;
use App\Http\Resources\MatchResource;
use App\Matchday;
use App\Season;
use Illuminate\Http\Request;

class AdminMatchdaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matchdays = Matchday::paginate(15);

        return view('admin/matchdays/index', compact('matchdays'));
    }

    /**
     * Api call to return matchdays
     *
     * @param $season_id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getMatchdays($season_id)
    {

        $matchdays = Matchday::whereSeasonId($season_id)->get();

        if ($matchdays->isNotEmpty()) {
            return MatchdayResource::collection($matchdays);
        } else {
            return response()->json([
                'message' => 'Matchdays not found'
            ], 204);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seasons = Season::all();

        return view('admin.matchdays.create', compact('seasons'));
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
            'season_id' => 'required',
            'matchday' => 'required|integer|between:0,100'
        ]);

        $input = $request->all();

        Matchday::create($input);

        return redirect(route('matchdays.index'));
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
        $matchday = Matchday::findOrFail($id);
        $seasons = Season::all();

        return view ('admin/matchdays/edit', compact('matchday', 'seasons'));
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
            'season_id' => 'required',
            'matchday' => 'required|integer|between:0,100'
        ]);

        $input = $request->all();

        $matchday = Matchday::findOrFail($id);

        $matchday->update($input);

        return redirect(route('matchdays.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matchday = Matchday::whereId($id);
        $matchday->delete();

        return redirect(route('matchdays.index'));
    }
}
