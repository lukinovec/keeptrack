{{-- <div class="flex justify-end w-full"> --}}
    <div x-data="{ destination: '/', currentRoute: '{{ basename(Request::url()) }}' }" x-init="'{{ Auth::check() }}' ? destination = '/home' : '/'"
        class="flex flex-wrap items-center justify-between w-full p-1 text-xl md:p-2">
            {{-- <span class="flex items-center justify-start flex-1 p-1 font-bold text-blueGray-300"> --}}
                <a :href="destination" class="flex items-center justify-center p-1 text-2xl font-extrabold text-blueGray-300 brand">
                    <img src="{{ asset('images/favicon-32x32.png') }}" alt="logo">
                    KeepTrack
                </a>
                <span x-show="'{{ Auth::check() }}'" class="flex justify-end lg:hidden">
                    <a href="javascript:;" x-show="'{{ Auth::check() }}'" wire:click="logout" class="p-1 md:p-2 btn">Log
                        out</a>
                </span>

                <span x-show="'{{ Auth::check() }}'" class="flex p-4 my-6 space-x-12 links">
                    <a href="/home" class="flex items-center justify-center p-1 text-lg font-bold text-center duration-75 transform text-blueGray-300 hover:scale-105"
                    :class='{"border-b-2 border-blueGray-300": currentRoute === "home"}'
                    >
                        <img class="w-6 m-2" src="{{ url(asset('images/lupa.svg')) }}" alt="">
                        Search
                    </a>
                    <a href="/library/movie" :class='{"border-b-2 border-blueGray-300": currentRoute === "movie"}'>
                        <livewire:library-link type="movie" />
                    </a>
                    <a href="/library/book" :class='{"border-b-2 border-blueGray-300": currentRoute === "book"}'>
                        <livewire:library-link type="book" />
                    </a>
                    <a href="/recent" class="flex items-center justify-center p-1 text-lg font-bold text-center duration-75 transform text-blueGray-300 hover:scale-105"
                    :class='{"border-b-2 border-blueGray-300": currentRoute === "recent"}'
                    >
                        <img class="w-6 m-2" src="{{ url(asset('images/star.svg')) }}" alt="">
                        Recent
                    </a>
                </span>

                <span x-show="'{{ Auth::check() }}'" class="justify-end hidden lg:flex ">
                    <a href="javascript:;" wire:click="logout" class="p-1 btn">Log
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