<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $userid = auth()->user()->id;
        $user = new User();
        $userData = $user->find($userid);

        // doing this because we added that relationship
        return view('home')->with('posts',$userData->posts);
    }
}
