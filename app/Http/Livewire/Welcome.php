<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class Welcome extends Component
{
    public function mount()
    {
        if (auth()->check()) {
            return redirect()->to("/home");
        }
    }

    public function render()
    {
        return view('livewire.welcome')
            ->extends('app')
            ->section('content');
    }
}