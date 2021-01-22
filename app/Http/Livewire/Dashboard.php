<?php

namespace App\Http\Livewire;

use App\Classes\Search;
use Livewire\Component;

class Dashboard extends Component
{
    public String $search = "";
    public String $searchtype = "movie";
    public $searchResponse = false;
    public $authUser;

    /**
     *
     */
    public function mount()
    {
        if (auth()->id()) {
            $this->authUser = auth()->id();
        } else {
            $this->authUser = "Not logged in.";
        }
    }

    /**
     *
     */
    public function startSearching()
    {
        if (strlen($this->search) > 2) {
            $this->searchResponse = Search::start($this->searchtype, trim($this->search))->makeRequest();
        } else {
            $this->searchResponse = [];
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
        return view('livewire.dashboard', [
            "searchResponse" => $this->searchResponse,
            "authUser" => $this->authUser,
        ])
            ->extends('app')
            ->section('content');
    }
}
