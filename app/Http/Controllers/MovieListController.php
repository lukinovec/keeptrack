<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;

class MovieListController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        $find = DB::table('movie_users')->where('user_id', $userid)->get();
        $data = array();
        foreach ($find as $item) {
            $selectMovie = DB::table('movies')->where('id', $item->movie_id)->first();
            $selectMovie->status = $item->status;
            $selectMovie->progress_episodes = $item->progress_episodes;
            array_push($data, $selectMovie);
        }
        return view('movielist')->with('data', $data);
    }
}
