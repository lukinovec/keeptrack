<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class Login extends Component
{
    public $email = "";
    public $password = "";

    public function login()
    {
        if (sha1($this->password) === User::where("email", $this->email)->value("password")) {
            session()->flash("message", "Logged in!");
            $token = User::where("email", $this->email)->first()->createToken('logged-in')->plainTextToken;
            return ["status_code" => 200, "access_token" => $token, "token_type" => "Bearer"];
        } else {
            session()->flash("message", "Bad login");
            return ["status_code" => 401];
        }
    }

    public function render()
    {
        return view("livewire.login");
    }
}
