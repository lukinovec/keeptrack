<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Classes\LibraryDB;
use Illuminate\Support\Facades\Auth;

class Menu extends Component
{
    public $clicked = "";
    public $authUser;
    public $latestMovie;
    public $library = [];

    protected $listeners = ["goToLibrary"];

    public function mount()
    {
        $this->library = [];
        $this->latestMovie = Auth::user()->movieList(1)->first();
        $this->authUser = Auth::user();
    }

    // Get user's movies or books based on where he clicked
    public function getLibrary()
    {
        if ($this->clicked === "books") {
            $this->library = $this->authUser->bookList();
        } else {
            $this->library = $this->authUser->movieList();
        }
    }

    public function updatedClicked($clicked)
    {
        $this->getLibrary();
        $this->emit("emitLibraryType", $clicked);
    }

    public function goToLibrary($searchtype)
    {
        $this->clicked = $searchtype;
        $this->getLibrary();
    }

    public function submitChanges($item)
    {
        $item["id"] = $item["apiID"] ?: $item["apiID"];
        LibraryDB::open()->updateDetails((object) $item);
    }

    public function render()
    {
        return view('livewire.menu', [
            'library' => $this->library,
            'latestMovie' => $this->latestMovie,
            'latestBook' => Auth::user()->bookList(1)->first()
        ]);
    }
}
