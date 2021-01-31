<div class="w-full h-full p-1" :class="{ 'overflow-hidden': !searchResponse }" x-data="{ searchtype: @entangle('searchtype'), searchResponse: @entangle('searchResponse'),  }">
    <div class="flex justify-center text-center">
        <div :class="{ 'visible lg:flex-1': !searchResponse }">
            <input name="searchinput" id="searchinput" wire:model.debounce.300ms="search"
            :placeholder="searchtype == 'anime' ? 'Type to search an ' + searchtype : 'Type to search a ' + searchtype"
            type="search" class="input" />
            <label for="searchinput">Search</label>

            <select class="p-2 select bg-blueGray-900" wire:model="searchtype" name="searchtype" id="searchtype">
                <option class="select-option" value="movie">TV / Movie</option>
                <option class="select-option" value="anime">Anime</option>
                <option class="select-option" value="book">Book</option>
            </select>
            <label for="searchtype">Type</label>
        </div>
    </div>

    <div class="w-full h-full">
        <div x-show="!searchResponse" class="w-full h-full" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100">
            <livewire:menu class="flex content-center w-full h-auto" id="menu" />
        </div>
        <br>

        <div wire:loading.delay class="loader" style="position: fixed; left: 50%; top: 7%">
        </div>
        <div x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100" x-show="searchResponse"
            class="flex flex-wrap items-center justify-center mt-4">

            @if ($searchResponse)

                @foreach ($searchResponse as $item)
                <livewire:result class="flex-none" :item="$item" :searchtype="$searchtype" :key="$searchtype === 'movie' ? $item['formattedId'] : $item['id']" />
                @endforeach

            @else

                No results found

            @endif
        </div>
    </div>
</div>