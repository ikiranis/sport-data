<?php

namespace App\Http\Controllers;

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

        return view('home', compact('sports'));
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

        return view('public.sport', compact('sport'));
    }
}
