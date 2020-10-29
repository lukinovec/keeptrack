<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = "";
    public $password = "";
    public $logging;
    public $error;

    // protected $rules = [
    //     "email" => "required|email",
    //     "password" => "required|password"
    // ];

    public function login()
    {
        // $this->validate();
        if (Auth::attempt(["email" => $this->email, "password" => $this->password])) {
            // Authentication passed...
            $this->logging = "text-green-700";
            $this->error = "Success!";
            return redirect()->intended("home");
        } else {
            $this->logging = "text-red-700";
            $this->error = "Invalid credentials. If you don't have an account, <a class='text-blue-600' href='http://localhost:8000/register'>register here.</a>";
        }
    }

    public function render()
    {
        return view("livewire.login", ["logging" => $this->logging, "error" => $this->error])
            ->extends('app')
            ->section('content');
    }
}
