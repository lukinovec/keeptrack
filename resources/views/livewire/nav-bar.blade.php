<div x-cloak x-data="{ destination: '/', currentRoute: '{{ basename(Request::url()) }}' }" x-init="'{{ Auth::check() }}' ? destination = '/home' : '/'"
        class="flex flex-col">
                <div class="flex justify-between flex-1 m-4">
                    <a title="Home" :href="destination" class="flex items-center justify-center p-1 text-2xl font-extrabold duration-75 transform hover:scale-105 text-blueGray-300 brand">
                        <img class="mx-2" width="24px" src="{{ asset('images/news.svg') }}" alt="logo">
                        KeepTrack
                    </a>
                        <a title="Log out" href="javascript:;" x-show="'{{ Auth::check() }}'" wire:click="logout" class="flex items-center justify-center w-20 btn">Log
                            out
                        </a>
                </div>

                <div class="flex flex-wrap items-center w-full p-1 text-xl justify-evenly md:p-2">
                    <a title="Search" x-show="'{{ Auth::check() }}'" href="/home" class="flex items-center justify-center p-1 text-lg font-bold text-center duration-75 transform text-blueGray-300 hover:scale-105"
                    :class='{"border-b-2 border-blueGray-300": currentRoute === "home"}'>
                        <img class="w-6 m-2" src="{{ url(asset('images/lupa.svg')) }}" alt="search image">
                        Search
                    </a>

                    <a title="Link to your library" x-show="'{{ Auth::check() }}'" href="/library/{{ Auth::id() }}" :class='{"border-b-2 border-blueGray-300": currentRoute === "library"}'>
                        <livewire:library-link />
                    </a>
                </div>
    </div>
    <div wire:loading.delay wire:target='login' class="loader" style="position: fixed; left: 50%; top: 7%">
</div>