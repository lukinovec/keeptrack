<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookListController extends Controller
{
    public function index()
    {
        $userid = Auth::user()->id;
        $find = DB::table('book_users')->where('user_id', $userid)->get();
        $data = array();
        foreach ($find as $item) {
            $selectBook = DB::table('books')->where('id', $item->book_id)->first();
            $selectBook->status = $item->status;
            $selectBook->progress_pages = $item->progress_pages;
            array_push($data, $selectBook);
        }
        return view('booklist')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $updateProgress = DB::table('book_users')->where('user_id', Auth::user()->id)->where('book_id', $id)->update(['progress_pages' => $request->input("progress")]);
        return redirect('booklist');
    }
}
