<div class="flex flex-row w-full justify-evenly">
    <div x-data="{ destination: '/' }" x-init="'{{ Auth::check() }}' ? destination = '/home' : '/'"
        class="p-12 space-x-1 text-xl sm:space-x-4 sm:space-x-16">
        <a :href="destination" class="p-2 btn">Home</a>
        <a href="javascript:;" x-show="'{{ Auth::check() }}'" wire:click="logout" class="p-2 btn">Log
            out</a>
        {{-- @if (Route::is('login'))
        <a class="p-2 btn" x-show="!'{{ Auth::check() }}'" href="/register">Register</a>
        @elseif(Route::is('register'))
        <a class="p-2 btn" x-show="!'{{ Auth::check() }}'" href="/login">Login</a>
        @endif --}}
    </div>
    <div wire:loading.delay wire:target='login' class="loader" style="position: fixed; left: 50%; top: 7%">
        </div>
</div>