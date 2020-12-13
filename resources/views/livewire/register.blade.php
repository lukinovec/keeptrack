<div class="auth-wrapper absolute" style="top: 20%" x-data="{ confirmed: @entangle('confirmed') }">
    <div class="auth">
        <input class="input w-full" placeholder="Email" type="email" wire:model.defer="email" name="email" />
        <br><br>
        <input class="input w-full" placeholder="Password" type="password" wire:model="password" name="password" />
        <br><br>
        <input class="input w-full" :class="confirmed" placeholder="Confirm password" type="password"
            wire:model="password_confirmation" name="confirm_password" />

        <div class="flex">
            <button class="btn auth-btn-primary" wire:click="register">Register</button>
            <button class="btn auth-btn-secondary" wire:click="login">Login</button>
        </div>

    </div>
    @if ($errors)
    <div class="auth-error">
        @foreach ($errors->all() as $message)
        {{$message}}
        @endforeach
    </div>
    @endif
</div>