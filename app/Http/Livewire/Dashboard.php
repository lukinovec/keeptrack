<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Dashboard extends Component
{
    // protected $listeners = ["isSearch"];
    public String $search = "";
    public String $searchtype = "movie";
    public $isSearch = false;
    public $response;

    public function updated()
    {
        $this->search !== "" ? $this->isSearch = true : $this->isSearch = false;
        $this->getResults();
    }

    public function getResults()
    {
        $response = Http::get('https://www.omdbapi.com', [
            'apikey' => '22d5a333',
            's' => $this->search,
        ]);
        $this->response = $response->json()["Search"];
    }

    public function render()
    {
        return view('livewire.dashboard', ["isSearch" => $this->isSearch, "results" => $this->response]);
    }
}
