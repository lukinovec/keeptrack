<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NavBar extends Component
{
    public $toggleSearch = true;
    public function logout()
    {
        Auth::logout();
        return redirect()->route("welcome");
    }

    public function updatedToggleSearch()
    {
        $this->emit("toggleSearch", $this->toggleSearch);
    }

    public function render()
    {
        return view('livewire.nav-bar', ['toggleSearch' => $this->toggleSearch])
            ->extends('app')
            ->section('content');
    }
}
