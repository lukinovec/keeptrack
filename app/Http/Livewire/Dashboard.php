<?php

namespace App\Http\Livewire;

use App\Classes\Search;
use Livewire\Component;

class Dashboard extends Component
{
    public String $search = "";
    public String $formattedSearch = "";
    public String $searchtype = "movie";
    public $details;
    public $isSearch = false;
    public $response;
    public $loading = false;

    public function updated()
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

    public function getDetails($id)
    {
        if ($id) {
            $search = new Search("details", $id);
            $this->loading = true;
            $this->details = $search->makeSearch();
            $this->loading = false;
        }
    }

    public function render()
    {
        return view('livewire.dashboard', ["isSearch" => $this->isSearch, "results" => $this->response, "details" => $this->details, "loading" => $this->loading])
            ->extends('app')
            ->section('content');
    }
}
