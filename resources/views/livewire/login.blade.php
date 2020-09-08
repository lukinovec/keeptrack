<div>
    <input type="email" name="email" wire:model="email" />
    <input type="password" name="password" wire:model="password" />
    <button wire:click="login">Login</button>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
</div>