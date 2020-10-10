<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Result extends Component
{
    public $item;

    public function mount($item)
    {
        $this->item = $item;
    }

    public function render()
    {
        return view('livewire.result', ["item" => $this->item]);
    }
}
