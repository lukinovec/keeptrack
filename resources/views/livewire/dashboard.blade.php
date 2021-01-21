<div class="w-full h-full" x-data="{ searchtype: @entangle('searchtype'), isSearch: @entangle('isSearch'),  }">
    <div class="flex justify-center text-center">
        <div :class="{ 'visible lg:flex-1': !isSearch }">
            <input wire:model.debounce.300ms="search"
                :placeholder="searchtype == 'anime' ? 'Search an ' + searchtype : 'Search a ' + searchtype"
                type="search" class="input" />

            <select class="p-2 select bg-blueGray-900" wire:model="searchtype" name="searchtype" id="searchtype">
                <option class="select-option" value="movie">TV / Movie</option>
                <option class="select-option" value="anime">Anime</option>
                <option class="select-option" value="book">Book</option>
            </select>
        </div>
    </div>

    <div class="w-full h-full">
        <div x-show="!isSearch" class="w-full h-full" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100">
            <livewire:menu class="flex content-center w-full h-auto" id="menu" />
        </div>
        <br>

        <div wire:loading.delay class="loader" style="position: fixed; left: 50%; top: 7%">
        </div>
        <div x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100" x-show="isSearch"
            class="flex flex-wrap items-center justify-center mt-4">

            @if ($results)

                @foreach ($results as $item)
                <livewire:result class="flex-none" :item="$item" :searchtype="$searchtype" :key="$searchtype === 'movie' ? $item['formattedId'] : $item['id']" />
                @endforeach

            @else

                No results found

            @endif
        </div>
    </div>
</div>