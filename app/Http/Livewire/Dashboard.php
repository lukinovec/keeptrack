<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
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
            $this->searchtype === "movie" ? $this->getMovies() : "";
        } else {
            $this->isSearch = false;
        }
    }

    public function getMovies()
    {
        $response = Http::get('https://www.omdbapi.com', [
            'apikey' => '22d5a333',
            's' => $this->formattedSearch,
        ]);
        $this->response = $response->json()["Search"];
    }

    public function render()
    {
        return view('livewire.dashboard', ["isSearch" => $this->isSearch, "results" => $this->response]);
    }
}
