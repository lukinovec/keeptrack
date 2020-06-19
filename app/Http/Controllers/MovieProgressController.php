<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieProgressController extends Controller
{
    public function update($id)
    {
        $updateProgress = DB::table('movie_users')->where('user_id', Auth::user()->id)->where('movie_id', $id)->update(['progress_episodes' => request("progress")]);
        return redirect('movielist');
    }
}
