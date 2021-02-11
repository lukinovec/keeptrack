<div class="flex flex-col items-center justify-between w-full h-full p-1 text-center" :class="{ 'overflow-hidden lg:pt-48': !searchResponse }" x-data="{ searchtype: @entangle('searchtype'), searchResponse: @entangle('searchResponse'),  }">
    <h1 x-show="searchResponse">You can add a <span x-text="searchtype"></span> to your library by selecting a status</h1>
        <div class="flex flex-col items-center justify-center w-1/2 md:flex-row" :class="{ 'visible': !searchResponse }">
                {{-- <label class="m-1 text-xs" for="searchinput">Search</label> --}}
                <span class="flex items-center flex-1">
                    <img class="w-6 m-2" src="{{ url(asset('images/lupa.svg')) }}" alt="">
                    <input name="searchinput" id="searchinput" wire:model.debounce.300ms="search"
                    :placeholder="searchtype == 'anime' ? 'Type to search an ' + searchtype : 'Type to search a ' + searchtype"
                    type="search" class="flex-1 h-12 my-3 input" />
                </span>

                <span class="flex items-center justify-center my-3">
                    {{-- <label class="m-1 text-xs" for="searchtype">Type</label> --}}
                    <select class="p-2 select bg-blueGray-900" wire:model="searchtype" name="searchtype" id="searchtype">
                        @foreach(\App\Models\Status::all() as $status)
                        <option class="select-option" value="{{ $status->type }}">{{ ucfirst($status->type) }}s</option>
                        @endforeach
                    </select>
                </span>
            </div>

        <div wire:loading.delay class="loader" style="position: fixed; left: 50%; top: 8%">
        </div>

        <div x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100" x-show="searchResponse"
            class="flex flex-wrap items-center justify-center mt-4">

            @if ($searchResponse && count($searchResponse) > 0)

                @foreach ($searchResponse as $item)
                @if($item["type"] != "game")
                <livewire:result :item="$item" :searchtype="$searchtype" :key="$item['id']" />
                @endif
                @endforeach

            @else

                No results found

            @endif
        </div>

        <p class="flex flex-wrap items-end justify-center p-3 text-blueGray-300 footer">
                Icons made by <a href="https://www.freepik.com" class="px-2 underline" title="Freepik">Freepik</a> from <a class="px-2 underline" href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
        </p>

</div>