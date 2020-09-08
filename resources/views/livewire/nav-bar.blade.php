<div>
    <a href="{{ route('home') }}" class="text-6xl text-blue-400">KeepTrack</a>
    @if (!Auth::check())
    <a href="{{ route('login') }}" class="m-5">Login</a>
    <a href="{{ route('register') }}" class="m-5">Register</a>
    @else
    <button type="button" wire:click="logout">Logout</button>
    @endif
</div>