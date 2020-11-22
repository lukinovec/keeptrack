<div class="h-full w-full" x-data="{ infoid: @entangle('infoid'), searchtype: @entangle('searchtype'), isSearch: @entangle('isSearch'),
    libraryType: @entangle('libraryType'), showSearch: @entangle('showSearch') }">
    <div class="text-center justify-center flex">
        <div x-show="!libraryType || showSearch" :class="{ 'visible lg:flex-1': libraryType && !isSearch }">
            <input wire:model.debounce.300ms="search" x-on:focus="infoid = ''"
                :placeholder="searchtype == 'anime' ? 'Search an ' + searchtype : 'Search a ' + searchtype"
                type="search" class="input" />

            <select class="select" x-show="!libraryType" wire:model="searchtype" name="searchtype" id="searchtype">
                <option class="select-option" value="movie">TV / Movie</option>
                <option class="select-option" value="anime">Anime</option>
                <option class="select-option" value="book">Book</option>
            </select>
        </div>
    </div>

    <div class="h-full w-full">
        <div x-show="!isSearch" class="h-auto w-full" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100">
            <livewire:menu class="h-auto w-full" id="menu" />
        </div>
        <br>

        <div wire:loading.delay class="loader" style="position: fixed; left: 50%; top: 7%">
        </div>
        <div x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100" x-show="isSearch" class="mt-4 flex flex-wrap"
            :class="{ 'items-center justify-center' : infoid === '' }">
            @if ($results)
            @foreach ($results as $item)
            <livewire:result class="flex-none" :item="$item" :infoid="$infoid" :key="$item['id']" />
            @endforeach
            @else
            No results found
            @endif
            @if ($details)
            <br>
            <div x-show="infoid" class="flex-1">
                <div>
                    <br><br>
                    <span class="font-bold"> {{ var_dump($details) }} </span> <br>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>