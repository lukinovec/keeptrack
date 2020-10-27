<?php

namespace App\Http\Livewire;

use App\Classes\Search;
use Livewire\Component;
use App\Movie;
use App\Book;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public String $search = "";
    public String $searchtype = "movie";
    public $details;
    public $isSearch = false;
    public $library;
    public $response;
    public String $infoid = "";
    public $test; // = "Dashboard.php report - nektere polozky nejdou pridat (prostredni, nekdy vpravo) - missing ) after argument list"
    public $authUser;
    public $statuses = [
        "completed" => "completed",
        "ptw" => "ptw",
        "watching" => "watching"
    ];

    protected $listeners = ["changeStatus", "libraryGot"];

    public function mount()
    {
        if (Auth::id()) {
            $this->authUser = Auth::id();
        } else {
            $this->authUser = "Not logged in.";
        }

        if ($this->test) {
            return dd($this->test);
        }
    }

    public function libraryGot($library)
    {
        $this->library = $library;
    }

    public function startSearching()
    {
        if (strlen($this->search) > 2) {
            $this->isSearch = true;
            $this->response = Search::start($this->search)->makeSearch($this->searchtype);
        } else {
            $this->isSearch = false;
        }
    }

    public function updatedSearch()
    {
        $this->startSearching();
    }

    public function updatedSearchtype()
    {
        $this->startSearching();
    }

    // Show details
    public function updatedInfoid($id)
    {
        if ($id) {
            $this->details = Search::start($id)->makeSearch($this->searchtype . "_details");
        }
    }

    public function changeStatus(String $item, String $status)
    {
        $item = json_decode($item);
        if ($item->type != "book") {
            // $library->updateMovieStatus($item, $status);
            Movie::updateStatus($item, $status);
        } else {
            Book::updateStatus($item, $status);
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
            "test" => $this->test
        ])
            ->extends('app')
            ->section('content');
    }
}
