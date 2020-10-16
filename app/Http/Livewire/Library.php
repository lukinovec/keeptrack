<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Library extends Component
{
    public $library;

    public function mount($library)
    {
        $this->library = $library;
    }

    public function render()
    {
        return view('livewire.library', ["library" => $this->library])
            ->extends('app')
            ->section('content');
    }
}
