<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public string $email = "";
    public string $password = "";
    public $error;

    public function login()
    {
        if (Auth::attempt(["email" => $this->email, "password" => $this->password])) {
            // Authentication passed...
            return redirect()->intended("home");
        }
        $this->error = "Invalid credentials. If you don't have an account, click the 'Don't have an account?' button.";
    }

    public function forgotPassword()
    {
        return redirect("forgot-password");
    }

    public function register()
    {
        return redirect("register");
    }

    public function render()
    {
        return view("livewire.auth.login", ["error" => $this->error])
            ->extends('app')
            ->section('content');
    }
}
