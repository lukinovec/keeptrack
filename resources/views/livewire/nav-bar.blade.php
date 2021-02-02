{{-- <div class="flex justify-end w-full"> --}}
    <div x-data="{ destination: '/' }" x-init="'{{ Auth::check() }}' ? destination = '/home' : '/'"
        class="flex justify-between w-full p-1 space-x-1 text-xl md:p-4 sm:space-x-2">
            <span class="flex p-1 font-bold text-blueGray-300">
                <a :href="destination" class="flex items-center justify-center text-xl font-extrabold brand">
                    <img src="{{ asset('images/favicon-32x32.png') }}" alt="logo">
                    KeepTrack
                </a>
                {{-- @if (Route::currentRouteName() === "home")
                    [obrázek] Dashboard
                    @else
                    [obrázek] Library
                @endif --}}
                @if (Route::currentRouteName() === "library")
                <span class="ml-8">
                    Your library
                </span>
                @endif
            </span>
            <span class="mt-3">
                <a :href="destination" class="p-2 btn">Home</a>
                <a href="javascript:;" x-show="'{{ Auth::check() }}'" wire:click="logout" class="p-2 btn">Log
                    out</a>
            </span>
        {{-- @if (Route::is('login'))
        <a class="p-2 btn" x-show="!'{{ Auth::check() }}'" href="/register">Register</a>
        @elseif(Route::is('register'))
        <a class="p-2 btn" x-show="!'{{ Auth::check() }}'" href="/login">Login</a>
        @endif --}}
    </div>
    <div wire:loading.delay wire:target='login' class="loader" style="position: fixed; left: 50%; top: 7%">
        </div>
{{-- </div> --}}