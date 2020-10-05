<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\User;

class Menu extends Component
{
    public $clicked = "";
    public $authUser;
    public $library;

    public function getLibrary()
    {
        if ($this->clicked === "movies") {
            $this->library = dd(User::find($this->authUser)->movies());
        } elseif ($this->clicked === "books") {
            $this->library = User::find($this->authUser)->books();
        } else {
            $this->library = "";
        }
    }

    public function updatedClicked()
    {
        $this->getLibrary();
    }

    public function render()
    {
        return view('livewire.menu', ['library' => $this->library]);
    }
}
