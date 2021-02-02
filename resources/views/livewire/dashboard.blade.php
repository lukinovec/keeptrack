<div class="flex flex-col items-center justify-between w-full h-full p-1 text-center" :class="{ 'overflow-hidden lg:pt-48': !searchResponse }" x-data="{ searchtype: @entangle('searchtype'), searchResponse: @entangle('searchResponse'),  }">
        <div class="flex items-center justify-center w-full" :class="{ 'visible': !searchResponse }">
                {{-- <label class="m-1 text-xs" for="searchinput">Search</label> --}}
                <input name="searchinput" id="searchinput" wire:model.debounce.300ms="search"
                :placeholder="searchtype == 'anime' ? 'Type to search an ' + searchtype : 'Type to search a ' + searchtype"
                type="search" class="w-1/2 h-12 my-3 lg:w-1/4 input" />
                <span class="flex items-center justify-center my-3">
                    {{-- <label class="m-1 text-xs" for="searchtype">Type</label> --}}
                    <select class="p-2 select bg-blueGray-900" wire:model="searchtype" name="searchtype" id="searchtype">
                        <option class="select-option" value="movie">TV / Movie</option>
                        <option class="select-option" value="anime">Anime</option>
                        <option class="select-option" value="book">Book</option>
                    </select>
                </span>
                <button wire:click="startSearching" class="p-2 btn">Search</button>
        </div>

        <div wire:loading.delay wire:target='startSearching' class="loader" style="position: fixed; left: 50%; top: 8%">
        </div>
        <div x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100" x-show="searchResponse"
            class="flex flex-wrap items-center justify-center mt-4">

            @if ($searchResponse && count($searchResponse) > 0)

                @foreach ($searchResponse as $item)
                <livewire:result :item="$item" :searchtype="$searchtype" :key="$searchtype === 'movie' ? $item['formattedId'] : $item['id']" />
                @endforeach

            @else

                No results found

            @endif
        </div>

        <p class="flex items-end justify-center p-3 text-blueGray-300 footer">
                Icons made by <a href="https://www.freepik.com" class="px-2 underline" title="Freepik">Freepik</a> from <a class="px-2 underline" href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
        </p>

</div>