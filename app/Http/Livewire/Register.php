<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $email = "";
    public $password = "";
    public $confirm = "";
    public $confirmed = "border-blue-600";
    public $newUser;
    public $getUserByEmail;

    public function updatedConfirm()
    {
        if ($this->password === $this->confirm) {
            $this->confirmed = "border-green-400";
        } else {
            $this->confirmed = "border-red-400";
        }
    }

    public function mount()
    {
        $this->getUserByEmail = User::first("email", $this->email);
    }

    public function register()
    {
        if ($this->email !== "") {
            if ($this->getUserByEmail === null) {
                if ($this->password === $this->confirm) {
                    User::create([
                        "name" => $this->email,
                        "email" => $this->email,
                        "password" => Hash::make($this->password),
                    ]);
                    session()->flash("message", "Registered successfuly!");
                    return redirect('home');
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
        return view("livewire.register", ["confirmed" => $this->confirmed])
            ->extends('app')
            ->section('content');
    }
}
