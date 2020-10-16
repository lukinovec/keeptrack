<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Movie;
use App\Book;
use App\User;
use App\BookUser;

class Menu extends Component
{
    public $clicked = "";
    public $authUser;
    public $authUserID;
    public $library = [];

    // TBD BOOKS
    // Book methods messed up, refactored Movies to use model methods, need to do the same for books later
    public function mount()
    {
        $this->library = [];
        $this->authUser = User::find($this->authUserID);
    }

    // Get user's movies or books based on where he clicked
    public function getLibrary()
    {
        if ($this->clicked === "movies") {
            $this->library = $this->authUser->movieList();
        } elseif ($this->clicked === "books") {
            $this->library = $this->authUser->bookList();
        } else {
            $this->library = "";
        }
    }

    public function updatedClicked()
    {
        $this->getLibrary();
    }

    public function render()
    {
        return view('livewire.menu', ['library' => $this->library]);
    }
}
