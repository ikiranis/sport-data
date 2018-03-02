<?php

namespace App\Http\Controllers;

use App\Post;
use App\Sport;

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
        $posts = Post::paginate(5);

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
        $posts = Post::whereSportId($sport->id)->paginate(5);

        return view('public.sport', compact('sport', 'posts'));
    }

    public function post($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();

        return view('public.post', compact('post'));
    }
}
