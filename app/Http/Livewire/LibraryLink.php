<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LibraryLink extends Component
{
    public $type = "";
    public $classes = "flex items-center justify-center text-lg font-bold duration-75 transform text-blueGray-300 hover:scale-105";
    public $svg_classes = "w-12 p-2 bg-transparent rounded-full";


    public function mount($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.library-link', [
            "type" => $this->type,
            "classes" => $this->classes
        ]);
    }
}
