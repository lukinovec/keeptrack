<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = "";
    public $password = "";

    public function login()
    {
        if (Auth::attempt(["email" => $this->email, "password" => $this->password])) {
            // Authentication passed...
            return redirect()->intended("home");
        } else {
            return redirect()->intended("register");
        }
    }

    public function render()
    {
        return view("livewire.login")
            ->extends('app')
            ->section('content');
    }
}
