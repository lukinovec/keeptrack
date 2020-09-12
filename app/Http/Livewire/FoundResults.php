<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;


class FoundResults extends Component
{
    protected $listeners = ["receiveSearch", "receiveSearchtype"];
    public $search = "";
    public $searchtype = "movie";
    public $response;

    public function updatingSearch()
    {
        $response = Http::get('https://www.omdbapi.com', [
            'apikey' => '22d5a333',
            's' => $this->search,
        ]);
        $this->response = $response;
    }

    public function receiveSearch($query)
    {
        $this->search = $query;
    }

    public function receiveSearchtype($query)
    {
        $this->searchtype = $query;
    }

    public function render()
    {
        return view('livewire.found-results', ["results" => $this->response]);
    }
}
