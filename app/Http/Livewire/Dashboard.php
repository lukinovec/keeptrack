<?php

namespace App\Http\Livewire;

use App\Classes\Search;
use App\Classes\Library;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public String $search = "";
    public String $formattedSearch = "";
    public String $searchtype = "movie";
    public $details;
    public $isSearch = false;
    public $response;
    public $loading = false;
    public String $infoid = "";
    public $test; // = "Dashboard.php report - nektere polozky nejdou pridat (prostredni, nekdy vpravo) - missing ) after argument list"
    public $authUser;
    public $statuses = [
        "completed" => "completed",
        "ptw" => "ptw",
        "watching" => "watching"
    ];

    protected $listeners = ['changeStatus'];

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

    public function startSearching()
    {
        if (strlen($this->search) > 2) {
            $this->isSearch = true;
            $this->formattedSearch = preg_replace('/\s+/', '+', $this->search);
            $search = new Search($this->formattedSearch);
            $this->response = $search->makeSearch($this->searchtype);
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
            $search = new Search($id);
            $this->loading = true;
            $this->details = $search->makeSearch($this->searchtype . "_details");
            $this->loading = false;
        }
    }

    public function changeStatus(String $item, String $status)
    {
        $library = new Library($this->authUser);
        $library->updateMovieStatus(json_decode($item), $status);
        $this->startSearching();
    }

    public function render()
    {
        return view('livewire.dashboard', [
            "isSearch" => $this->isSearch,
            "results" => $this->response,
            "details" => $this->details,
            "loading" => $this->loading,
            "infoid" => $this->infoid,
            "authUser" => $this->authUser,
            "statuses" => $this->statuses,
            "test" => $this->test
        ])
            ->extends('app')
            ->section('content');
    }
}
