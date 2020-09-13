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
        // if (sha1($this->password) === User::where("email", $this->email)->value("password")) {
        //     session()->flash("message", "Logged in!");
        //     $token = User::where("email", $this->email)->first()->createToken('logged-in')->plainTextToken;
        //     return ["status_code" => 200, "access_token" => $token, "token_type" => "Bearer"];
        // } else {
        //     session()->flash("message", "Bad login");
        //     return ["status_code" => 401];
        // }

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
