<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Sport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminSportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sports = Sport::paginate(15);

        return view('admin/sports/index', compact('sports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sports.create');
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

        if ($file = $request->uploadFile->isValid()) {
            $file = $request->uploadFile;

            $imgName = time() . '.' . $file->extension();
            $path = Carbon::now()->month;

            $file->move('images/' . $path, $imgName);

            $photo = Photo::create(['path' => $path, 'filename' => $imgName, 'reference' => '']);

            $input['photo_id'] = $photo->id;

        } else {
            return 'problem';
        }

        $sport = Sport::create($input);

        return redirect(route('sports.index'));
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
        //
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
        //
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
