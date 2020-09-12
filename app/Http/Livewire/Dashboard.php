<?php

namespace App\Http\Livewire;


use Livewire\Component;

class Dashboard extends Component
{
    protected $listeners = ["isSearch"];
    public $search = "";
    public $isSearch = false;

    public function isSearch()
    {
        $this->isSearch = true;
    }

    public function render()
    {
        return view('livewire.dashboard', ["isSearch" => $this->isSearch]);
    }
}
