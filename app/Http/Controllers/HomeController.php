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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sports = Sport::all();

        return view('home', compact('sports'));
    }

    public function sport($slug)
    {
        $sport = Sport::where('slug', $slug)->first();

        return view('public.sport', compact('sport'));
    }
}
