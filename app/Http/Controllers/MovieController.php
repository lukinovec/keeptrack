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

        //$userid = Auth::user()->id;
        //$insert = DB::insert('insert into movies (imdbID, image, name, director, description, year) values (?, ?)', [1, 'Dayle']);
        $name = $request->input('name');
        return $name;
    }
}
