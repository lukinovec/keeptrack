<div class="mt-40" x-data="{ confirmed: @entangle('confirmed') }">
    <div class="text-center text-2xl w-full">
        <input class="form-input" placeholder="Email" type="email" wire:model="email" name="email" /> <br><br>
        <input class="form-input" placeholder="Password" type="password" wire:model="password" name="password" />
        <br><br>
        <input class="form-input" :class="confirmed" placeholder="Confirm password" type="password"
            wire:model="password_confirmation" name="confirm_password" /> <br><br>
        <div>
            <button wire:click="register" class="btn mt-4">Register</button>
        </div>

        @if ($errors)
        <div class="alert alert-success mt-5">
            @foreach ($errors->all() as $message)
            {{$message}}
            @endforeach
        </div>
        @endif
    </div>
</div>