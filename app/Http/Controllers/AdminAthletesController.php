<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Photo;
use App\Sport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminAthletesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $athletes = Athlete::orderBy('lname', 'asc')->paginate(15);

        return view('admin/athletes/index', compact('athletes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sports = Sport::all();

        return view('admin.athletes.create', compact('sports'));
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
            'photo_id' => 'nullable',
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'birthyear' => 'nullable|integer|between:1930,2030',
            'city' => 'nullable|max:255',
            'country' => 'nullable|max:255',
            'height' => 'nullable|integer|between:100,230'
        ]);

        $input = $request->all();

        if ($file = $request->uploadFile) {
            if ($file->isValid()) {

                $imgName = time() . '.' . $file->extension();
                $path = Carbon::now()->month;

                $file->move('images/' . $path, $imgName);

                $photo = Photo::create(['path' => $path, 'filename' => $imgName, 'reference' => $request->reference]);

                $input['photo_id'] = $photo->id;

                // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop

            } else {
                return 'problem';
            }
        }

        Athlete::create($input);

        return redirect(route('athletes.index'));
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
        $athlete = Athlete::findOrFail($id);
        $sports = Sport::all();

        return view ('admin/athletes/edit', compact('athlete', 'sports'));
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
            'photo_id' => 'nullable',
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'birthyear' => 'nullable|integer|between:1930,2030',
            'city' => 'nullable|max:255',
            'country' => 'nullable|max:255',
            'height' => 'nullable|integer|between:100,230'
        ]);

        $input = $request->all();

        $athlete = Athlete::findOrFail($id);

        if($file = $request->uploadFile) {
            if ($file->isValid()) {

                $imgName = time() . '.' . $file->extension();
                $path = Carbon::now()->month;

                $file->move('images/' . $path, $imgName);

                $photo = Photo::create(['path' => $path, 'filename' => $imgName, 'reference' => $request->reference]);

                $input['photo_id'] = $photo->id;

                // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop

            } else {
                return 'problem';
            }
        }

        $athlete->update($input);

        return redirect(route('athletes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $athlete = Athlete::whereId($id);
        $athlete->delete();

        return redirect(route('athletes.index'));
    }
}
