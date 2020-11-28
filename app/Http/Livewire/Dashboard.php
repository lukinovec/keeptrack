<?php

namespace App\Http\Livewire;

use App\Classes\Search;
use Livewire\Component;

class Dashboard extends Component
{
    public String $search = "";
    public String $searchtype = "movie";
    public $isSearch = false;
    public $showSearch = false;
    public $response;
    public $test;
    public $authUser;

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

    public function startSearching()
    {
        if (strlen($this->search) > 2) {
            $this->response = Search::start(trim($this->search))->type($this->searchtype);
            $this->isSearch = true;
        } else {
            $this->isSearch = false;
        }
    }

    public function updated($updated_property)
    {
        if ($updated_property == "search" || $updated_property == "searchtype") {
            $this->reset('response');
            $this->startSearching();
        }
    }

    public function render()
    {
        return view('livewire.dashboard', [
            "isSearch" => $this->isSearch,
            "results" => $this->response,
            "authUser" => $this->authUser,
        ])
            ->extends('app')
            ->section('content');
    }
}
