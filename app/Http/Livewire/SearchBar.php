<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchBar extends Component
{
    public String $search = "";
    public String $searchType = "movie";
    // protected $updatesQueryString = ['search'];

    public function search()
    {
        $this->searchType === "movie" ? $this->formatMovieResults() : $this->formatBookResults();
    }

    protected function getMovieResults()
    {
        return Http::post('https://www.omdbapi.com', [
            'apikey' => '22d5a333',
            's' => $this->search,
        ]);
    }

    public function formatMovieResults()
    {
        $response = $this->getMovieResults();
        $response = $response->data["Search"];
        foreach ($response as $result) {
            $result["Director"] === "N/A" ? $result["Director"] = $result["Writer"] : "";
        }
        $this->emit("showResults", $response);
    }

    public function formatBookResults()
    {
        return "TBD";
    }


    // public function mount()
    // {
    //     $this->search = request()->query('search', $this->search);
    // }

    public function render()
    {
        return view("livewire.search-bar");
    }
}
