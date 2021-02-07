<div class="absolute auth-wrapper" style="top: 10%" x-data="{}">
    <span class="text-lg font-bold text-blueGray-300">
        Forgot your password? <br> Submit your email and we'll send you a link to reset it.
    </span>
    <div class="flex items-center justify-center text-lg auth">
        <input type="email" wire:model.defer="email" x-on:keydown.enter="$wire.sendResetLink()" class="flex-1 input" name="email" placeholder="Email" />
        <button class="w-24 p-1 m-0 ml-2 btn auth-btn-primary" wire:click="sendResetLink()">Submit</button>
    </div>

    <div class="auth-error">
    {!! $errorMessage !!}
    </div>

    <div wire:loading.delay wire:target='sendResetLink' class="loader" style="position: fixed; left: 50%; top: 7%">
</div>
