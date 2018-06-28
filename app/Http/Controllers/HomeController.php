<?php

namespace App\Http\Controllers;

use App\Athlete;
use App\Championship;
use App\Comment;
use App\Match;
use App\Matchday;
use App\Post;
use App\Season;
use App\Sport;
use App\src\Standings;
use App\Tag;
use App\Team;
use Carbon\Carbon;
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
        $sports = Sport::whereMainpage(1)->orderBy('name', 'asc')->get();
        $otherSports = Sport::whereMainpage(0)->orderBy('name', 'asc')->get();

        $posts = Post::whereApproved(1)->orderBy('created_at', 'desc')->simplePaginate(5);
        $seasons = Season::all();
        $lastMatches = Match::where('match_date', '<', Carbon::now())
            ->where('first_team_score', '<>', null)
            ->orderBy('match_date', 'desc')
            ->limit(5)
            ->get();
        $nextMatches = Match::where('match_date', '>=', Carbon::yesterday())
            ->where('first_team_score', '=', null)
            ->orderBy('match_date', 'asc')
            ->limit(5)
            ->get();


        return view('public.home', compact('sports', 'otherSports', 'posts', 'seasons', 'lastMatches', 'nextMatches'));
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
        $posts = Post::whereSportId($sport->id)->whereApproved(1)->orderBy('created_at', 'desc')->simplePaginate(5);
        $championships = Championship::whereSportId($sport->id)->get();

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
    public function team($slug, Standings $standings)
    {

        // Get the team with $slug
        $team = Team::whereSlug($slug)->firstOrFail();

        // Get all the posts of $team_id
        $posts = $team->posts()->orderBy('created_at', 'desc')->simplePaginate(5);

        $seasons = Season::whereChampionshipId($team->championship_id)->get();

        $teamsStandingsArray = [];

        foreach ($seasons as $season) {

            $matches = Match::whereChampionshipId($team->championship_id)->
                whereSeasonId($season->id)->
                orderBy('match_date', 'desc')->get();

            $standings->setMatches($matches);

            $championship = Championship::whereId($team->championship_id);

            // Pass rules as object
            $rules = json_decode(
                Season::whereChampionshipId($team->championship_id)->
                firstOrFail()->
                rule->
                description,
                false);
            $standings->setRules($rules);

            $teamsStandingsArray = null;
            if($championship->has_standings) {
                $teamsStandingsArray = $standings->getStandings();
            }

            $matchdays = Matchday::whereSeasonId($season->id)->get();
        }

        return view('public.teamPosts', compact('team', 'posts', 'teamsStandingsArray', 'seasons', 'matches', 'matchdays'));

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
        $posts = Post::whereAthleteId($athlete->id)->orderBy('created_at', 'desc')->simplePaginate(5);

        return view('public.athletePosts', compact('athlete', 'posts'));

    }

    /**
     *
     * Display standings home index page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function standings($championship_id, $season_id, Standings $standings)
    {

        $championship = Championship::whereId($championship_id)->firstOrFail();

        $season = Season::whereId($season_id)->firstOrFail();

        $matches = Match::whereChampionshipId($championship_id)->
            whereSeasonId($season_id)->
            orderBy('match_date', 'desc')->get();

        $standings->setMatches($matches);

        // Pass rules as object
        $rules = json_decode(
            Season::whereChampionshipId($championship_id)->
            firstOrFail()->
            rule->
            description,
            false);
        $standings->setRules($rules);

        $teamsStandings = null;
        if($championship->has_standings) {
            $teamsStandings = $standings->getStandings();
        }

        $matchdays = Matchday::whereSeasonId($season_id)->get();

        return view('public.standings', compact('teamsStandings', 'matches', 'matchdays', 'championship', 'season'));

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
            'author' => 'required|max:255'
        ]);

        $input = $request->all();

        $input['email'] = 'null';

        Comment::create($input);

        $request->session()->flash('commentSaved', 'Το σχόλιο σου καταχωρήθηκε και θα εμφανιστεί σύντομα, μόλις εγκριθεί από τον διαχειριστή');

        return redirect(route('post', $request->post_slug));
    }

    /**
     * Search posts
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::whereApproved(1)
            ->where(function($query) use ($search) {
                $query->where('body', 'LIKE', "%$search%")
                    ->orWhere('title', 'LIKE', "%$search%")
                    ->orWhere('description', 'LIKE', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->simplePaginate(5);

        // Append search text for next pages
        $posts->appends(['search' => $search]);

        return view('public.search', compact('search', 'posts'));
    }

    /**
     * Tag posts
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tag($slug)
    {
        // Get the team with $slug
        $tag = Tag::whereSlug($slug)->firstOrFail();

        // Get all the posts of $team_id
        $posts = $tag->posts()->orderBy('created_at', 'desc')->simplePaginate(5);

        return view('public.tagPosts', compact('tag', 'posts'));
    }
}
