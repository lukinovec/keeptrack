<?php

namespace App\Http\Livewire;

use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Livewire\Component;
use Password;
use Str;

class ResetPassword extends Component
{
    public $token = "";
    public $errorMessage = "";
    public $email;
    public $password;
    public $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function changePassword()
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            ['email' => $this->email, 'password' => $this->password, 'password_confirmation' => $this->password_confirmation, 'token' => $this->token],
            function ($user) {
                $user->forceFill([
                    'password' => $this->password
                ])->save();
                $user->setRememberToken(Str::random(60));
                event(new PasswordReset($user));
            }
        );
        if ($status === Password::PASSWORD_RESET) {
            session()->flash("message", "<span class='text-green-600'>Password successfuly changed!</span>");
            return redirect("/");
        } else {
            $this->errorMessage = $status === Password::INVALID_TOKEN ? "<span class='text-red-600'>Invalid password reset token. Try resetting your password again.</span>" : "<span class='text-red-600'>An error has occured.</span>";
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password')
            ->extends('app')
            ->section('content');
    }
}
