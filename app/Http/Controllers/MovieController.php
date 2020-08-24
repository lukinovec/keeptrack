<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function all()
    {
        $user_id = Auth::id();
        return User::find($user_id)->movies();
    }
}
