<div class="mt-40" x-data="{ logging: @entangle('logging') }">
    <div class="text-center text-2xl w-full">
        <input type="email" class="form-input" name="email" placeholder="Email" wire:model="email" /> <br><br>
        <input type="password" class="form-input" name="password" placeholder="Password" wire:model="password" /> <br>
        <button href="#" class="btn mt-6 w-1/3" wire:click="login">Login</button>
        @if ($error)
        <div class="text-red-700">
            {!! $error !!}
        </div>
        @endif
    </div>


</div>