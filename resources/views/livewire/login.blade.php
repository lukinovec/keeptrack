<div class="absolute auth-wrapper" style="top: 20%" x-data="{}">
    <div class="auth">
        <input type="email" x-on:keydown.enter="$wire.login()" class="w-full input" name="email" placeholder="Email" wire:model.defer="email" />
        <br><br>
        <input type="password" x-on:keydown.enter="$wire.login()" class="w-full input" name="password" placeholder="Password"
            wire:model.defer="password" />
        <br>
        <span class="flex">
            <button class="btn auth-btn-primary" wire:click="login">Login</button>
            <button class="btn auth-btn-secondary" wire:click="register">Register</button>
        </span>
        <div wire:loading.delay wire:target='login' class="loader" style="position: fixed; left: 50%; top: 7%">
        </div>
    </div>
    @if ($errors)
    <div class="auth-error">
        {{ $error }}
    </div>
    @endif
</div>