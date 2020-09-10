<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class Register extends Component
{
    public $email = "";
    public $password = "";
    public $confirm = "";
    public $newUser;

    public function register()
    {
        if ($this->email !== "") {
            if (User::first("email", $this->email) === null) {
                if ($this->password === $this->confirm) {
                    return User::create([
                        "name" => $this->email,
                        "email" => $this->email,
                        "password" => bcrypt($this->password),
                    ]);
                    session()->flash("message", "Registered successfuly!");
                } else {
                    session()->flash("message", "Password and password confirmation are not matching.");
                }
            } else {
                session()->flash("message", "This email address is already associated with an existing account.");
            }
        } else {
            session()->flash("message", "The email is invalid.");
        }
    }

    public function render()
    {
        return view("livewire.register");
    }
}
