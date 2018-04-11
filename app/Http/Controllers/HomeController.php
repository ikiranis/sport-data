<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Sport;
use App\Team;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the public page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sports = Sport::all();
        $posts = Post::whereApproved(1)->orderBy('created_at', 'desc')->paginate(5);

        return view('public.home', compact('sports', 'posts'));
    }

    /**
     * Display public sport page
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sport($slug)
    {
        $sport = Sport::whereSlug($slug)->firstOrFail();
        $posts = Post::whereSportId($sport->id)->whereApproved(1)->orderBy('created_at', 'desc')->paginate(5);

        return view('public.sport', compact('sport', 'posts'));
    }

    /**
     * Display a single post
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function post($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
//            $comments = $post->comments()->orderBy('created_at', 'desc')->get();

        return view('public.post', compact('post'));
    }

    /**
     * Display home index posts page with team filter
     *
     * @param $team_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teamPosts($team_id)
    {

        // Get the team with $team_id
        $team = Team::whereId($team_id)->firstOrFail();

        // Get all the posts of $team_id
        $posts = $team->posts()->orderBy('created_at', 'desc')->paginate(5);

        $sports = Sport::all();

        // TODO Να το κάνω με άλλη view, που να μην εμφανίζει τα sports
        return view('public.home', compact('posts', 'sports'));

    }


    /**
     * Store a comment
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeComment(Request $request)
    {
        $input = $request->all();

        Comment::create($input);

        $request->session()->flash('commentSaved', 'Το σχόλιο σου καταχωρήθηκε και θα εμφανιστεί σύντομα, μόλις εγκριθεί από τον διαχειριστή');

        return redirect(route('post', $request->post_slug));
    }
}
