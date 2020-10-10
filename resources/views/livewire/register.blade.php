<div class="mt-40">
    <div class="text-center text-2xl w-full">
        <input class="form-input" placeholder="Email" type="email" wire:model="email" name="email" /> <br><br>
        <input class="form-input" placeholder="Password" type="password" wire:model="password" name="password" />
        <br><br>
        <input class="form-input border-blue-600" placeholder="Confirm password" type="password"
            wire:model.debounce.400ms="confirm" name="confirm_password" /> <br><br>
        <div>
            {{ $confirmed }}
            <button wire:click="register" class="btn mt-4">Register</button>
        </div>

        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
</div>