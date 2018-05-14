<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Http\Resources\SeasonResource;
use App\Matchday;
use App\Season;
use Illuminate\Http\Request;

class AdminSeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = Season::orderBy('name', 'asc')->paginate(15);

        return view('admin/seasons/index', compact('seasons'));
    }

    /**
     * Api that returns the Seasons list for championship_id
     *
     * @param $championship_id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getSeasons($championship_id)
    {
        $seasons = Season::whereChampionshipId($championship_id)->get();

        if ($seasons->isNotEmpty()) {
            return SeasonResource::collection($seasons);
        } else {
            return response()->json([
                'message' => 'Seasons not found'
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
        $championships = Championship::all();

        return view('admin.seasons.create', compact('championships'));
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
            'championship_id' => 'required',
            'name' => 'required|max:255'
        ]);

        $input = $request->all();

        $season = Season::create($input);

        for($counter=1; $counter<=$input['matchdays_number']; $counter++) {
            Matchday::create(['season_id' => $season->id, 'matchday' => $counter]);
        }

        return redirect(route('seasons.index'));
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
        $season = Season::findOrFail($id);
        $championships = Championship::all();

        return view ('admin/seasons/edit', compact('season', 'championships'));
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
            'championship_id' => 'required',
            'name' => 'required|max:255'
        ]);

        $input = $request->all();

        $season = Season::findOrFail($id);

        $season->update($input);

        return redirect(route('seasons.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $season = Season::whereId($id);
        $season->delete();

        return redirect(route('seasons.index'));
    }
}
