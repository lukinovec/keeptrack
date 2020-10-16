<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = "";
    public $password = "";
    public Bool $logging = false;
    public $error;

    public function login()
    {
        if (Auth::attempt(["email" => $this->email, "password" => $this->password])) {
            // Authentication passed...
            $this->logging = true;
            return redirect()->intended("home");
        } else {
            $this->logging = false;
            $this->error = "Invalid credentials. If you don't have an account, <a class='text-blue-600' href='http://localhost:8000/register'>register here.</a>";
        }
        // else {
        // return redirect()->intended("register");
        // }
    }

    public function render()
    {
        return view("livewire.login", ["logging" => $this->logging, "error" => $this->error])
            ->extends('app')
            ->section('content');
    }
}
