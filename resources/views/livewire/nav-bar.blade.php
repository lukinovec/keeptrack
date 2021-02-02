{{-- <div class="flex justify-end w-full"> --}}
    <div x-data="{ destination: '/' }" x-init="'{{ Auth::check() }}' ? destination = '/home' : '/'"
        class="flex flex-wrap items-center justify-between w-full p-1 text-xl md:p-2">
            {{-- <span class="flex items-center justify-start flex-1 p-1 font-bold text-blueGray-300"> --}}
                <a :href="destination" class="flex items-center justify-center text-2xl font-extrabold text-blueGray-300 brand">
                    <img src="{{ asset('images/favicon-32x32.png') }}" alt="logo">
                    KeepTrack
                </a>

                <div class="flex md:hidden">
                    <button id="hamburger" class="mx-3 text-blueGray-300">
                      <svg class="block fill-current toggle" viewBox="0 0 100 80" width="40" height="40">
                        <rect width="82" height="7"></rect>
                        <rect y="30" width="82" height="7"></rect>
                        <rect y="60" width="82" height="7"></rect>
                      </svg>
                      <img class="hidden toggle" src="https://img.icons8.com/fluent-systems-regular/2x/close-window.png" width="40" height="40" />
                    </button>
                </div>

                <span class="flex p-4 space-x-6 links">
                    <a href="/library/movie" :class='{{ last(request()->segments()) === "movie" ? "border-b-2 border-blueGray-300" : "" }}'>
                        <livewire:library-link type="movie" />
                    </a>
                    <a href="/library/book" :class='{{ last(request()->segments()) === "book" ? "border-b-2 border-blueGray-300" : "" }}'>
                        <livewire:library-link type="book" />
                    </a>
                </span>

                <span class="flex justify-end mt-3">
                    <a href="javascript:;" x-show="'{{ Auth::check() }}'" wire:click="logout" class="p-1 btn">Log
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