<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NavBar extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route("welcome");
    }

    public function render()
    {
        return view('livewire.nav-bar');
    }
}
