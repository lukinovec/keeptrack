<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $userid = Auth::user()->id;
        $checkDupe = DB::table('books')->where('goodreadsID', $request->id)->first();
        if (is_null($checkDupe)) {
            $insert = DB::insert('insert into books (image, name, author, year, goodreadsID) values (?, ?, ?, ?, ?)', [$request->image, $request->name, $request->director, $request->year, $request->id]);
        }
        $getId = DB::table('books')->select('id')->where('goodreadsID', $request->id)->first();
        $checkRelation = DB::table('book_users')->where('user_id', $userid)->where('book_id', $getId->id)->first();
        if (is_null($checkRelation)) {
            $add = DB::insert('insert into book_users (user_id, book_id, status) values (?, ?, ?)', [$userid, $getId->id, $request->status]);
        } elseif ($checkRelation->status != $request->status) {
            $update = DB::table('book_users')->where('user_id', $userid)->where('book_id', $getId->id)->update(['status' => $request->status]);
        }
    }
}
