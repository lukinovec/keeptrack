<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Classes\LibraryDB;
use Illuminate\Support\Facades\Auth;

class RecentlyUpdated extends Component
{
    public $latestBook;
    public $latestMovie;

    public function mount()
    {
        $this->latestMovie = Auth::user()->usersMovies(1)->firstWhere("seasons", "!==", "");
        $this->latestBook = Auth::user()->usersBooks(1)->first();
    }

    public function submitChanges($item)
    {
        $item["id"] = $item["apiID"] ?: $item["apiID"];
        LibraryDB::open()->updateDetails((object) $item);
    }

    public function render()
    {
        return view("livewire.recently-updated", [
            "latestBook" => $this->latestBook,
            "latestMovie" => $this->latestMovie
        ])->extends("app")->section("content");
    }
}
