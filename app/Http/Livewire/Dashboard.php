<?php

namespace App\Http\Livewire;

use App\Classes\Search;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $clicked = "";
    public $latestMovie;
    public $latestBook;
    public String $search = "";
    public String $searchtype = "movie";
    public $searchResponse = false;
    public $authUser;

    // protected $listeners = ["goToLibrary"];
    /**
     *
     */
    public function mount()
    {
        if (Auth::id()) {
            $this->authUser = Auth::id();
            $this->latestMovie = Auth::user()->usersMovies(1)->firstWhere("seasons", "!==", "");
            $this->latestBook = Auth::user()->usersBooks(1)->first();
        } else {
            $this->authUser = "Not logged in.";
        }
    }



    // Get user's movies or books based on where he clicked
    // public function getLibrary()
    // {
    //     if ($this->clicked === "books") {
    //         $this->library = $this->authUser->usersBooks();
    //     } else {
    //         $this->library = $this->authUser->usersMovies();
    //     }
    // }

    // public function updatedClicked($clicked)
    // {
    //     $this->getLibrary();
    //     $this->emit("emitLibraryType", $clicked);
    // }

    // public function goToLibrary($searchtype)
    // {
    //     $this->clicked = $searchtype;
    //     $this->getLibrary();
    // }

    /**
     *
     */
    public function startSearching()
    {
        if (strlen($this->search) > 2) {
            $this->searchResponse = Search::start($this->searchtype, trim($this->search))->makeRequest();
        } else {
            $this->searchResponse = false;
        }
    }

    /**
     *
     */
    public function updated($updated_property)
    {
        if ($updated_property == "search" || $updated_property == "searchtype") {
            $this->reset('searchResponse');
            $this->startSearching();
        }
    }

    public function render()
    {
        return view("livewire.dashboard", [
            "searchResponse" => $this->searchResponse,
            "authUser" => $this->authUser,
            "latestMovie" => $this->latestMovie,
            "latestBook" => $this->latestBook
        ])
            ->extends("app")
            ->section("content");
    }
}
