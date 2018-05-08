<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Championship;
use App\Comment;
use App\Match;
use App\Post;
use App\Season;
use App\Sport;
use App\src\Standings;
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
        $championships = Championship::whereSportId($sport->id)->all();

        return view('public.sport', compact('sport', 'posts', 'championships'));
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

        return view('public.post', compact('post'));
    }

    /**
     * Display home index posts page with team filter
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function team($slug)
    {

        // Get the team with $slug
        $team = Team::whereSlug($slug)->firstOrFail();

        // Get all the posts of $team_id
        $posts = $team->posts()->orderBy('created_at', 'desc')->paginate(5);

        return view('public.teamPosts', compact('team', 'posts'));

    }

    /**
     * Display home index posts page with athlete filter
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function athlete($slug)
    {

        // Get the athlete with $slug
        $athlete = Athlete::whereSlug($slug)->firstOrFail();

        // Get all the posts of $athlete->id
        $posts = Post::whereAthleteId($athlete->id)->orderBy('created_at', 'desc')->paginate(5);

        return view('public.athletePosts', compact('athlete', 'posts'));

    }

    /**
     *
     * Display standings home index page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function standings(Request $request, Standings $standings)
    {
        if ($request->has('_token')) { // If there are request data do filter
            $standings->setMatches(
                Match::whereChampionshipId($request->championship_id)->
                whereSeasonId($request->season_id)->
                orderBy('match_date', 'desc')->get()
            );

            $standings->setTeams(
                Team::whereChampionshipId($request->championship_id)->get()
            );

            // Pass rules as object
            $rules = json_decode(
                Championship::whereId($request->championship_id)->
                firstOrFail()->
                rule->
                description,
                false);
            $standings->setRules($rules);

            $teamsStandings = $standings->getStandings();

        } else {
            $teamsStandings = null;
        }


        return view('public.standings', compact('teamsStandings'));

    }

    /**
     * Store a comment
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeComment(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required',
            'author' => 'required|max:255',
            'email' => 'required|email'
        ]);

        $input = $request->all();

        Comment::create($input);

        $request->session()->flash('commentSaved', 'Το σχόλιο σου καταχωρήθηκε και θα εμφανιστεί σύντομα, μόλις εγκριθεί από τον διαχειριστή');

        return redirect(route('post', $request->post_slug));
    }
}
