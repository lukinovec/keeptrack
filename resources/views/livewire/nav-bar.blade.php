<div class="flex flex-row w-full justify-evenly">
    <div x-data="{ destination: '/', toggleSearch: @entangle('toggleSearch') }"
        x-init="'{{ Auth::check() }}' ? destination = '/home' : ''" class="p-12 sm:px-64 text-xl space-x-16">
        <a :href="destination" class="flex-1 border-b-2 float-left hover:border-black hover:text-black">Home</a>
        <a x-show="'{{ Auth::check() }}'" class="border-b-2 hover:border-black hover:text-black" href="#"
            x-on:click="toggleSearch = !toggleSearch" x-text="toggleSearch ? 'Hide Search' : 'Show Search'"></a>
        <a href="#" x-show="'{{ Auth::check() }}'" wire:click="logout"
            class="border-b-2 float-right hover:border-black hover:text-black">Log
            out</a>
    </div>
</div>