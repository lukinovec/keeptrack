<div class="absolute auth-wrapper" style="top: 10%" x-data="{ confirmed: @entangle('confirmed') }">
    <div class="auth">
        <input class="w-full input" placeholder="Email" type="email" wire:model.defer="email" name="email" />
        <br><br>
        <input class="w-full input" placeholder="New password" type="password" wire:model="password" name="password" />
        <br><br>
        <input class="w-full input" :class="confirmed" placeholder="Confirm password" type="password"
            wire:model="password_confirmation" name="confirm_password" />

        <button class="btn auth-btn-primary" wire:click="changePassword">Change Password</button>
    </div>
    @if ($errorMessage)
    <div class="auth-error">
        {!! $errorMessage !!}
    </div>
    @endif
</div>