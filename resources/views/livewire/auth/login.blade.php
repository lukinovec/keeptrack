<div class="w-3/5 text-center auth-wrapper" x-data="{}">
    @if (session()->has("message"))
    <div class="auth-error">
        {!! session("message") !!}
    </div>
    @endif
    <div class="auth">
        <input type="email" x-on:keydown.enter="$wire.login()" class="w-full input" name="email" placeholder="Email" wire:model.defer="email" />
        <br><br>
        <input type="password" x-on:keydown.enter="$wire.login()" class="w-full input" name="password" placeholder="Password"
            wire:model.defer="password" />
        <br>
        <button class="btn auth-btn-primary" wire:click="login">Log In</button>
        <span class="flex p-2 m-2 text-base justify-evenly text-blueGray-300">
            <button class="hover:underline" wire:click="forgotPassword">Forgot password?</button>
            <button class="hover:underline" wire:click="register">Don't have an account?</button>
        </span>
        <div wire:loading.delay wire:target='login' class="loader" style="position: fixed; left: 50%; top: 7%">
        </div>
    </div>
    @if ($errors)
    <div class="text-base auth-error">
        {{ $error }}
    </div>
    @endif

</div>