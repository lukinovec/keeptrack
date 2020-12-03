<div class="h-full w-full" x-data="{ searchtype: @entangle('searchtype'), isSearch: @entangle('isSearch') }">
    <div class="text-center justify-center flex">
        <div :class="{ 'visible lg:flex-1': !isSearch }">
            <input wire:model.debounce.300ms="search"
                :placeholder="searchtype == 'anime' ? 'Search an ' + searchtype : 'Search a ' + searchtype"
                type="search" class="input border-blueGray-500" />

            <select class="select bg-blueGray-900 p-2" wire:model="searchtype" name="searchtype" id="searchtype">
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
            x-transition:enter-end="opacity-100 transform scale-100" x-show="isSearch"
            class="mt-4 items-center justify-center flex flex-wrap">
            @if ($results)
            @if ($searchtype == "movie")
            @foreach ($results as $item)
            <livewire:result class="flex-none" :item="$item" :searchtype="$searchtype" :key="$item['formattedId']" />
            @endforeach
            @else
            @foreach ($results as $item)
            <livewire:result class="flex-none" :item="$item" :searchtype="$searchtype" :key="$item['id']" />
            @endforeach
            @endif
            @else
            No results found
            @endif
        </div>
    </div>
</div>