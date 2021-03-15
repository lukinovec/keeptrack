<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    public $errorMessage = "";
    public $email = "";

    public function sendResetLink()
    {
        $this->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(["email" => $this->email]);
        if ($status === Password::RESET_LINK_SENT) {
            session()->flash("message", "<span class='text-green-600'>Password reset link sent to your email!</span>");
            return redirect("/");
        } else {
            $this->errorMessage = $status === Password::INVALID_USER ? "<span class='text-red-600'>Couldn't find a user with this email address.</span>" : "<span class='text-red-600'>Email is not valid</span>";
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password', [
            "message" => $this->errorMessage
        ])->extends('app')
            ->section('content');
    }
}
