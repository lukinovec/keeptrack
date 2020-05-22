<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => "Home",

        );
        return view('home')->with($data);
    }

    public function welcome()
    {
        return view('welcome')->with('title', 'Welcome');
    }
}
