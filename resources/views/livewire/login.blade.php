<div class="auth-wrapper absolute" style="top: 20%" x-data="{ logging: @entangle('logging') }">
    <div class="auth">
        <input type="email" class="input w-full" name="email" placeholder="Email" wire:model.defer="email" />
        <br><br>
        <input type="password" class="input w-full" name="password" placeholder="Password"
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