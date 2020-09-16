<?php

namespace App\Http\Livewire;

use App\Classes\Search;
use Livewire\Component;

class Dashboard extends Component
{
    // protected $listeners = ["isSearch"];
    public String $search = "";
    public String $formattedSearch = "";
    public String $searchtype = "movie";
    public $isSearch = false;
    public $response;

    public function updated($name)
    {
        if (strlen($this->search) > 2) {
            $this->isSearch = true;
            $this->formattedSearch = preg_replace('/\s+/', '+', $this->search);
            $search = new Search($this->searchtype, $this->formattedSearch);
            $this->response = $search->makeSearch();
        } else {
            $this->isSearch = false;
        }
    }


    public function render()
    {
        return view('livewire.dashboard', ["isSearch" => $this->isSearch, "results" => $this->response])
            ->extends('app')
            ->section('content');
    }
}
