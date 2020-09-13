<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchBar extends Component
{
    public String $search = "";
    public String $searchtype = "movie";
    public $results;

    public function updatedSearch()
    {
        $this->emit("isSearch");
        $this->emit("receiveSearch", $this->search);
    }

    public function updatedSearchtype()
    {
        $this->emit("receiveSearchtype", $this->searchtype);
    }

    public function render()
    {
        return view("livewire.search-bar");
    }
}
