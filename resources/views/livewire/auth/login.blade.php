<div class="w-4/5 text-center sm:w-5/6 md:w-2/3 auth-wrapper" x-data="{}">
    <span class="flex flex-col items-center justify-center m-5 space-y-2 text-4xl font-bold text-blueGray-300">
        <span class="flex border-b-2 md:hidden border-blueGray-300">
            Welcome to KeepTrack!
        </span>
            <span class="text-xl font-normal">
                Please log in to continue.
            </span>
         </span>
    @if (session()->has("message"))
    <div class="text-sm auth-error">
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
        <span class="flex p-2 m-2 space-x-1 text-lg justify-evenly text-blueGray-300">
            <button class="font-bold hover:underline" wire:click="forgotPassword">Forgot password?</button>

            <button class="font-bold hover:underline" wire:click="register">Don't have an account?</button>
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