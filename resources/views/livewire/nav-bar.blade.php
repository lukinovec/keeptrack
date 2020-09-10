<div>
    <a href="{{ route('home') }}" class="text-6xl text-blue-400">KeepTrack</a>
    @if (Auth::check())
    <button type="button" wire:click="logout">Logout</button>
    @endif
</div>