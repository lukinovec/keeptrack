<?php

namespace App\Http\Livewire;

use App\Classes\Search;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $clicked = "";
    public $searching = false;
    public String $search = "";
    public String $searchtype = "movie";
    public $searchResponse = false;
    public $authUser;

    /**
     *
     */
    public function mount()
    {
        if (Auth::id()) {
            $this->authUser = Auth::id();
        } else {
            $this->authUser = "Not logged in.";
        }
    }

    /**
     *
     */
    public function startSearching()
    {
        $this->searching = true;
        if (strlen(trim($this->search)) > 2) {
            $this->searchResponse = Search::start($this->searchtype, trim($this->search))->makeRequest();
        } else {
            $this->searchResponse = false;
        }
        $this->searching = false;
    }

    /**
     *
     */
    public function updated($updated_property)
    {
        if ($updated_property == "search" || $updated_property == "searchtype" && !$this->searching) {
            $this->reset('searchResponse');
            $this->startSearching();
        }
    }

    public function render()
    {
        return view("livewire.dashboard", [
            "searchResponse" => $this->searchResponse,
            "authUser" => $this->authUser,
        ])
            ->extends("app")
            ->section("content");
    }
}
