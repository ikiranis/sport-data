<?php

namespace App\Http\Controllers;

use App\Championship;
use App\Division;
use App\Http\Resources\TeamResource;
use App\Logo;
use App\Sport;
use App\Team;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminTeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Api that returns the teams list for sport_id
     *
     * @param $sport_id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getTeams($sport_id)
    {
        $teams = Team::whereSportId($sport_id)->get();

        if ($teams->isNotEmpty()) {
            return TeamResource::collection($teams);
        } else {
            return response()->json([
                'message' => 'Teams not found'
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
        $divisions = Division::orderBy('name', 'asc')->all();
        $sports = Sport::orderBy('name', 'asc')->all();
        $championships = Championship::orderBy('name', 'asc')->all();

        return view('admin.teams.create', compact('divisions', 'sports', 'championships'));
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
            'logo_id' => 'nullable',
            'name' => 'required|max:255',
            'city' => 'nullable|max:255',
            'link' => 'nullable|url|max:255'
        ]);

        $input = $request->all();

        if ($file = $request->uploadFile) {
            if ($file->isValid()) {

                $imgName = time() . '.' . $file->extension();
                $path = Carbon::now()->month;

                $file->move('images/' . $path, $imgName);

                $logo = Logo::create(['path' => $path, 'filename' => $imgName]);

                $input['logo_id'] = $logo->id;

                // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop

            } else {
                return 'problem';
            }
        }

        Team::create($input);

        return redirect(route('teams.index'));
    }

    /**
     * Api call to store a team
     *
     * @param Request $request
     * @return TeamResource
     */
    public function storeTeam(Request $request)
    {
        $input = $request->all();

        if ($team = Team::create($input)) {
            return new TeamResource($team);
        } else {
            return response()->json([
                'message' => 'Cant create team'
            ], 403);
        }
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
        $team = Team::findOrFail($id);
        $divisions = Division::orderBy('name', 'asc')->all();
        $sports = Sport::orderBy('name', 'asc')->all();
        $championships = Championship::orderBy('name', 'asc')->all();

        return view ('admin/teams/edit', compact('team', 'divisions', 'sports', 'championships'));
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
            'logo_id' => 'nullable',
            'name' => 'required|max:255',
            'city' => 'nullable|max:255',
            'link' => 'nullable|url|max:255'
        ]);

        $input = $request->all();

        $team = Team::findOrFail($id);

        if ($file = $request->uploadFile) {
            if ($file->isValid()) {

                $imgName = time() . '.' . $file->extension();
                $path = Carbon::now()->month;

                $file->move('images/' . $path, $imgName);

                $logo = Logo::create(['path' => $path, 'filename' => $imgName]);

                $input['logo_id'] = $logo->id;

                // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop

            } else {
                return 'problem';
            }
        }

        $team->update($input);

        return redirect(route('teams.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::whereId($id);
        $team->delete();

        return redirect(route('teams.index'));
    }
}
