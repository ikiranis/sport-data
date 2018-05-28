<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Championship;
use App\Division;
use App\Photo;
use App\Post;
use App\Sport;
use App\Team;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);

        return view('admin/posts/index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        $athletes = Athlete::all();
        $sports = Sport::all();
        $championships = Championship::all();
        $divisions = Division::all();
        $user_id = Auth::id();

        $userApiToken = Auth::user()->api_token;

        return view('admin.posts.create', compact('teams', 'athletes', 'user_id', 'sports', 'championships', 'divisions', 'userApiToken'));
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
            'slug' => 'nullable',
            'team_selected' => 'nullable',
            'photo_id' => 'nullable',
            'user_id' => 'nullable',
            'athlete_id' => 'nullable',
            'match_id' => 'nullable',
            'sport_id' => 'required',
            'title' => 'required|max:255',
            'description' => 'nullable|max:500',
            'body' => 'required',
            'reference' => 'nullable|max:800',
            'approved' => 'nullable'
        ]);

        // TODO δεν δέχεται το required του body. Για κάποιον λόγο γίνεται και το κενό validated

        $input = $request->all();

        if ($file = $request->uploadFile) {
            if ($file->isValid()) {

                $imgName = time() . '.' . $file->extension();
                $path = Carbon::now()->month;

                $file->move('images/' . $path, $imgName);

                $photo = Photo::create(['path' => $path, 'filename' => $imgName, 'reference' => $request->photo_reference]);

                $input['photo_id'] = $photo->id;

                // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop

            } else {
                return 'problem';
            }
        }

        $post = Post::create($input);

        $post->teams()->attach($request->teams_selected); // Insert teams relation with pivot table

        return redirect(route('posts.index'));
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
        $post = Post::findOrFail($id);
        $teams = Team::all();
        $athletes = Athlete::all();
        $sports = Sport::all();

        return view ('admin/posts/edit', compact('post', 'teams', 'athletes', 'sports'));
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
            'slug' => 'nullable',
            'photo_id' => 'nullable',
            'user_id' => 'nullable',
            'athlete_id' => 'nullable',
            'match_id' => 'nullable',
            'sport_id' => 'required',
            'title' => 'required|max:255',
            'description' => 'nullable|max:500',
            'body' => 'required',
            'reference' => 'nullable|max:800',
            'approved' => 'nullable'
        ]);

        $input = $request->all();

        $post = Post::findOrFail($id);

        if($file = $request->uploadFile) {
            if ($file->isValid()) {

                $imgName = time() . '.' . $file->extension();
                $path = Carbon::now()->month;

                $file->move('images/' . $path, $imgName);

                $photo = Photo::create(['path' => $path, 'filename' => $imgName, 'reference' => $request->photo_reference]);

                $input['photo_id'] = $photo->id;

                // TODO Χρήση του plugin για ανέβασμα φωτογραφιών με drag'n'drop

            } else {
                return 'problem';
            }
        } else {
            if($photo = Photo::find($post->photo_id)) {
                $photo->update(['reference' => $request->photo_reference]);
            }
        }

        $post->update($input);

        $post->teams()->sync($request->teams_selected); // Sync teams relation with pivot table

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::whereId($id);
        $post->delete();

        return redirect(route('posts.index'));
    }
}
