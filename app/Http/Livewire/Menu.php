<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Menu extends Component
{
    public $clicked = "";
    public $authUser;
    public $latestMovie;
    public $library = [];

    public function mount()
    {
        $this->library = [];
        $this->latestMovie = Auth::user()->usersMovies(1)->firstWhere("seasons", "!==", "");
        $this->latestBook = Auth::user()->usersBooks(1)->first();
        $this->authUser = Auth::user();
    }

    // Get user's movies or books based on where he clicked
    public function getLibrary()
    {
        if ($this->clicked === "books") {
            $this->library = $this->authUser->usersBooks();
        } else {
            $this->library = $this->authUser->usersMovies();
        }
    }

    public function updatedClicked($clicked)
    {
        $this->getLibrary();
        $this->emit("emitLibraryType", $clicked);
    }

    public function render()
    {
        return view('livewire.menu', [
            'library' => $this->library,
            'latestMovie' => $this->latestMovie,
            'latestBook' => $this->latestBook
        ]);
    }
}
