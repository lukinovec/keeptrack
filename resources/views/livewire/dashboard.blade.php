<div class="h-full w-full"
    x-data="{ infoid: @entangle('infoid'), searchtype: @entangle('searchtype'), isSearch: @entangle('isSearch'), libraryType: @entangle('libraryType'), showSearch: @entangle('showSearch'), toggleSearch: @entangle('toggleSearch') }">
    <div x-show="toggleSearch" class="text-center justify-center flex">
        {{-- <div x-show="!libraryType || showSearch" wire:click="$emit('goToLibrary', '{{$searchtype}}')"
        class="text-center p-5 text-white font-bold bg-red-800">
        Go to Library
    </div> --}}
    <div x-show="!libraryType || showSearch"
        :class="{ 'visible lg:flex-1': libraryType && !isSearch, 'flex-1': !libraryType }">
        <input wire:model.debounce.300ms="search" x-on:focus="infoid = ''" :placeholder="'Search a ' + searchtype"
            type="search" class="text-2xl border-b-2 focus:border-gray-400" />

        <select x-show="!libraryType" wire:model="searchtype" name="searchtype" id="searchtype">
            <option value="movie">TV / Movie</option>
            <option value="book">Book</option>
        </select>
        <x-search-switch />
    </div>

    <div x-show="libraryType && !showSearch" class="flex-1 relative inline">
        <input wire:model.debounce.300ms="librarysearch" placeholder="Search {{ $libraryType }} in library"
            type="search" class="text-2xl border-b-2 focus:border-gray-400" />
        <x-search-switch />
    </div>
</div>

<div class="h-full w-full">
    <div x-show="!isSearch" class="h-auto w-full" x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100">
        <livewire:menu class="h-auto w-full" id="menu" />
    </div>
    <br>
    <div class="fixed bg-black bg-opacity-50 rounded-lg p-4 text-white left-0 right-0 mx-auto text-center"
        style="width: 100px" wire:loading>
        <img src="{{ asset('images/loading.gif') }}" alt="">
        Loading, please wait
    </div>
    <div x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-show="isSearch" class="mt-4 flex flex-wrap"
        :class="{ 'items-center justify-center' : infoid === '' }">
        @if ($results)
        @foreach ($results as $item)
        <livewire:result :item="$item" :key="$item['id']" />
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
                {{-- <span class="font-bold"> {{ $details["Plot"] }} </span> <br> --}}
            </div>
        </div>
        @endif
    </div>
</div>
</div>