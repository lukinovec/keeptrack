<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LibraryLink extends Component
{
    public $type = "";

    public function mount($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.library-link', [
            "type" => $this->type,
        ]);
    }
}
