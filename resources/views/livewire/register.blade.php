<div class="absolute auth-wrapper" style="top: 20%" x-data="{ confirmed: @entangle('confirmed') }">
    <div class="auth">
        <input class="w-full input" placeholder="Email" x-on:keydown.enter="$wire.register()" type="email" wire:model.defer="email" name="email" />
        <br><br>
        <input class="w-full input" placeholder="Password" x-on:keydown.enter="$wire.register()" type="password" wire:model="password" name="password" />
        <br><br>
        <input class="w-full input" :class="confirmed" x-on:keydown.enter="$wire.register()" placeholder="Confirm password" type="password"
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