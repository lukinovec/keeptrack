<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public string $email = "";
    public string $password = "";
    public string $password_confirmation = "";
    public $confirmed;
    public User $newUser;

    protected $rules = [
        'email' => 'required|email:rfc,dns|unique:users,email',
        'password' => 'required|confirmed'
    ];

    public function updated($prop)
    {
        if ($prop == "password_confirmation") {
            if ($this->password === $this->password_confirmation) {
                $this->confirmed = "border-green-400";
            } else {
                $this->confirmed = "border-red-400";
            }
        }
    }

    public function register()
    {
        $this->validate();
        $newUser = User::create([
            "email" => $this->email,
            "password" => $this->password
        ]);
        Auth::login($newUser);
        return redirect("home");
    }

    public function login()
    {
        return redirect("/");
    }

    public function render()
    {
        return view("livewire.auth.register", ["confirmed" => $this->confirmed])
            ->extends('app')
            ->section('content');
    }
}
