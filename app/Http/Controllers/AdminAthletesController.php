<?php

namespace App\Http\Controllers;

use App\Athlete;
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
        $athletes = Athlete::paginate(15);

        return view('admin/athletes/index', compact('athletes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.athletes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view ('admin/athletes/edit', compact('athlete'));
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

        $athlete = Athlete::findOrFail($id);

//        if($file = $request->uploadFile) {
//            if ($file->uploadFile->isValid()) {
//
//                $imgName = time() . '.' . $file->extension();
//                $path = Carbon::now()->month;
//
//                $file->move('images/' . $path, $imgName);
//
//                $photo = Photo::create(['path' => $path, 'filename' => $imgName, 'reference' => $request->reference]);
//
//                $input['photo_id'] = $photo->id;
//
//                // TODO σετάρισμα του nginx να δέχεται μεγαλύτερες φωτογραφίες
//                // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop
//
//            } else {
//                return 'problem';
//            }
//        }



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
        //
    }
}
