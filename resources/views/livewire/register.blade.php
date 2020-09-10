<div>
    <div class="text-center text-2xl w-full">
        <input class="form-input" placeholder="Email" type="email" wire:model="email" name="email" /> <br>
        <input class="form-input" placeholder="Password" type="password" wire:model="password" name="password" /> <br>
        <input class="form-input" placeholder="Confirm password" type="password" wire:model="confirm"
            name="confirm_password" /> <br>
        <button wire:click="register" class="btn mt-4">Register</button>

        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    </div>
    @endif
</div>