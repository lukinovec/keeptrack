<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->data);
        // $title = $request->input('');
        // $search = $request->input('userinput');
        $userid = Auth::user()->id;
        // $checkDupe = DB::select('select * from movies where imdbID = ?', [$request->id]);
        $checkDupe = DB::table('movies')->where('imdbID', $request->id)->first();
        if (is_null($checkDupe)) {
            $insert = DB::insert('insert into movies (image, name, director, year, imdbID) values (?, ?, ?, ?, ?)', [$request->image, $request->name, $request->director, $request->year, $request->id]);
        }
        $getId = DB::table('movies')->select('id')->where('imdbID', $request->id)->first();
        $checkRelation = DB::table('movie_users')->where('user_id', $userid)->where('movie_id', $getId->id)->first();
        if (is_null($checkRelation)) {
            $add = DB::insert('insert into movie_users (user_id, movie_id) values (?, ?)', [$userid, $getId->id]);
        }
    }
}
