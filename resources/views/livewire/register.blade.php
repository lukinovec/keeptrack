<div>
    <input class="border border-black" placeholder="Email" type="email" wire:model="email" name="email" />
    <input class="border border-black" placeholder="Password" type="password" wire:model="password" name="password" />
    <input class="border border-black" placeholder="Confirm password" type="password" wire:model="confirm"
        name="confirm_password" />
    <button wire:click="register">Register</button>

    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
</div>