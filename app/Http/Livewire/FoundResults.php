<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FoundResults extends Component
{
    public $show;
    protected $listeners = ["showResults"];

    public function showResults($results)
    {
        $this->show = $results;
    }

    public function render()
    {
        return view('livewire.found-results', ["show" => $this->show]);
    }
}
