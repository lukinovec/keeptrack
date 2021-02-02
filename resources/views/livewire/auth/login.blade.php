<div class="absolute auth-wrapper" style="top: 20%" x-data="{}">
    <div class="auth">
        <input type="email" x-on:keydown.enter="$wire.login()" class="w-full input" name="email" placeholder="Email" wire:model.defer="email" />
        <br><br>
        <input type="password" x-on:keydown.enter="$wire.login()" class="w-full input" name="password" placeholder="Password"
            wire:model.defer="password" />
        <br>
            <button class="btn auth-btn-primary" wire:click="login">Log In</button>
            {{-- <button class="btn auth-btn-secondary" wire:click="register">Register</button> --}}
        <span class="flex p-2 m-2 text-base justify-evenly text-blueGray-300">
            <button class="hover:underline">Forgot password?</button>
            <button class="hover:underline" wire:click="register">Don't have an account?</button>
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