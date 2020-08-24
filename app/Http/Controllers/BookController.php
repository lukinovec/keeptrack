<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function all()
    {
        $user_id = Auth::id();
        return User::find($user_id)->books();
    }
}
