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
    public Bool $updating_message = true;
    public String $searchtype = "movie";
    public $searchResponse = false;
    public $minYear = null;
    public $maxYear = null;
    public $authUser;

    protected $listeners = ["changing-status" => "onStatusChange"];
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
        $this->reset('searchResponse');
        if (strlen(trim($this->search)) > 2) {
            $this->searchResponse = Search::start($this->searchtype, trim($this->search))->makeRequest();
            $this->searching = false;
        } else {
            $this->searchResponse = false;
        }
    }

    public function onStatusChange($message, $type = "info")
    {
        $this->updating_message = false;
        flash($message)->{$type}()->livewire($this);
    }

    /**
     *
     */
    public function updated($updated_property)
    {
        if ($updated_property == "search" || $updated_property == "searchtype" && !$this->searching) {
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
