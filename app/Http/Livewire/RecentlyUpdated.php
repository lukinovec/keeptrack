<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Classes\LibraryDB;

class RecentlyUpdated extends Component
{
    public $latestBook;
    public $latestMovie;

    public function mount($latestBook, $latestMovie)
    {
        $this->latestBook = $latestBook;
        $this->latestMovie = $latestMovie;
    }

    public function submitChanges($item)
    {
        $item["id"] = $item["apiID"] ?: $item["apiID"];
        LibraryDB::open()->updateDetails((object) $item);
    }

    public function render()
    {
        return view('livewire.recently-updated', [
            "latestBook" => $this->latestBook,
            "latestMovie" => $this->latestMovie
        ]);
    }
}
