<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use aharen\OMDbAPI;

class PagesController extends Controller
{

    public function index()
    {
        $data = array(
            'title' => "Home",

        );

        return view('home')->with($data);
    }

    public function moviesearch()
    {
        $omdb = new OMDbAPI('22d5a333',);
        $search = $omdb->search('spider');
        $index = 0;
        $data = array(
            'search' => $search,
            'index' => strval($index)
        );
        return view('moviesearch')->with($data);
    }

    public function welcome()
    {
        return view('welcome')->with('title', 'Welcome');
    }
}
