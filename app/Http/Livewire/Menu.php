<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Menu extends Component
{
    public $clicked = "";
    public $authUser;
    public $library = [];

    protected $listeners = ["goToLibrary"];

    // TBD BOOKS
    // Book methods messed up, refactored Movies to use model methods, need to do the same for books later
    public function mount()
    {
        $this->library = [];
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

    public function goToLibrary($item)
    {
        $this->clicked = json_decode($item)->type;
        $this->getLibrary();
    }

    public function render()
    {
        return view('livewire.menu', ['library' => $this->library]);
    }
}
