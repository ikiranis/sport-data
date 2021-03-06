<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Http\Resources\ChampionshipResource;
use App\Rule;
use App\Sport;
use Illuminate\Http\Request;

class AdminChampionshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $championships = Championship::orderBy('name', 'asc')->paginate(15);

        return view('admin/championships/index', compact('championships'));
    }

    /**
     * Api that returns the Championships list for sport_id
     *
     * @param $sport_id
     * @return mixed
     */
    public function getChampionships($sport_id)
    {

        $championships = Championship::whereSportId($sport_id)->get();

        if ($championships->isNotEmpty()) {
            return ChampionshipResource::collection($championships);
        } else {
            return response()->json([
                'message' => 'Championships not found'
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
        $sports = Sport::orderBy('name', 'asc')->get();

        return view('admin.championships.create', compact('sports'));
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
            'name' => 'required|max:255',
        ]);

        $input = $request->all();

        Championship::create($input);

        return redirect(route('championships.index'));
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
        $championship = Championship::findOrFail($id);
        $sports = Sport::orderBy('name', 'asc')->get();

        return view ('admin/championships/edit', compact('championship', 'sports'));
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
            'name' => 'required|max:255',
        ]);

        $input = $request->all();

        $championship = Championship::findOrFail($id);

        $championship->update($input);

        return redirect(route('championships.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $championship = Championship::whereId($id);
        $championship->delete();

        return redirect(route('championships.index'));
    }
}
