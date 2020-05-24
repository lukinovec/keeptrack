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

    public function search(Request $request)
    {
        $searchtype = $request->input('searchtype');
        $search = $request->input('userinput');
        if ($searchtype == "movies") {
            $omdb = new OMDbAPI('22d5a333');
            $search = $omdb->search($search)->data;
        } elseif ($searchtype == "books") {
            $search = "kniha";
        }

        if (isset($search->Error)) {
            return "Not Found";
        } else {
            return $search->Search;
        }
    }


    public function welcome()
    {
        return view('welcome')->with('title', 'Welcome');
    }
}
