<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LibraryLink extends Component
{
    public $classes = "flex items-center justify-center text-lg font-bold
    rounded-full duration-75 transform text-blueGray-300 hover:scale-105";
    public $svg_classes = "w-12 h-12 p-2 bg-transparent";

    public function render()
    {
        return view('livewire.library-link', [
            "classes" => $this->classes
        ]);
    }
}
