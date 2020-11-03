<?php

namespace App\Http\Livewire;

use App\Classes\Search;
use Livewire\Component;
use App\Movie;
use App\Book;

class Dashboard extends Component
{
    public String $search = "";
    public String $searchtype = "movie";
    public $details;
    public $isSearch = false;
    public $library;
    public $libraryType;
    public $isLibrarySearch;
    public $showSearch = false;
    public $librarysearch = "";
    public $response;
    public String $infoid = "";
    public $test;
    public $authUser;
    public $statuses = [
        "completed" => "completed",
        "ptw" => "ptw",
        "watching" => "watching"
    ];

    protected $listeners = ["changeStatus", "emitLibraryType" => "getLibraryType", "goToLibrary"];

    public function mount()
    {
        if (auth()->id()) {
            $this->authUser = auth()->id();
        } else {
            $this->authUser = "Not logged in.";
        }

        if ($this->test) {
            return dd($this->test);
        }
    }

    public function getLibraryType($type)
    {
        $this->libraryType = $type;
        $this->isLibrarySearch = true;
    }

    public function goToLibrary($item = null)
    {
        $this->libraryType = json_decode($item)->type ?? $this->searchtype;
        $this->isSearch = false;
    }

    public function switchSearch()
    {
        $this->showSearch = !$this->showSearch;
        $this->showSearch == false ? $this->goToLibrary() : "";
    }

    public function startSearching()
    {
        if (strlen($this->search) > 2) {
            $this->isSearch = true;
            $this->response = Search::start($this->search)->type($this->searchtype);
        } else {
            $this->isSearch = false;
        }
    }

    public function updated($updated_property)
    {
        $updated_property == "search" || $updated_property == "searchtype" ? $this->startSearching() : "";
    }

    public function updatedLibrarysearch($search)
    {
        $this->emit("librarySearch", $search);
    }

    // Show details if ID exists
    public function updatedInfoid($id)
    {
        $this->details = Search::start($id)->type($this->searchtype . "_details") ?: false;
    }

    public function changeStatus(String $item, String $status)
    {
        $item = json_decode($item);
        if ($item->type == "book") {
            Book::updateStatus($item, $status);
        } else {
            Movie::updateStatus($item, $status);
        }
    }

    public function render()
    {
        return view('livewire.dashboard', [
            "isSearch" => $this->isSearch,
            "results" => $this->response,
            "details" => $this->details,
            "infoid" => $this->infoid,
            "authUser" => $this->authUser,
            "statuses" => $this->statuses,
            "test" => $this->test,
            "librarysearch" => $this->librarysearch
        ])
            ->extends('app')
            ->section('content');
    }
}
