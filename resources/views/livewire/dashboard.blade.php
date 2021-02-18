<div class="flex flex-col items-center justify-between w-full h-full p-1 text-center" :class="{ 'overflow-hidden lg:pt-48': !searchResponse }"
x-data="{ searchtype: @entangle('searchtype'), searchResponse: @entangle('searchResponse'), filter: false, minYear: 1, maxYear: new Date().getFullYear(),
    filterByYear: function(year) {
        let years = year.split('–');
        if(years.length > 1) {
            return parseInt(years[0]) >= this.minYear && (parseInt(years[1]) ?? this.maxYear) <= this.maxYear;
        } else {
            return parseInt(year) >= this.minYear && parseInt(year) <= this.maxYear;
        }
    }
}">
        <h1 x-show="searchResponse">You can add a <span x-text="searchtype"></span> to your library by selecting a status</h1>
        <div class="flex flex-col items-center justify-center w-1/2 space-x-2" :class="{ 'visible': !searchResponse }">
                {{-- <label class="m-1 text-xs" for="searchinput">Search</label> --}}

        <div class="p-4 m-4 text-lg">
            <span x-on:click="filter = !filter" class="font-bold underline cursor-pointer text-blueGray-300">
                Filter by year?
            </span>
            <span x-show="filter" class="flex items-center justify-center m-3 space-x-3 text-blueGray-300">
                <input class="w-16 bg-transparent border-b-2 border-blueGray-300" x-model.number="minYear" type="number">
                 <span>to</span>
                 <input class="w-16 bg-transparent border-b-2 border-blueGray-300" type="number" x-model.number="maxYear">
                 <span x-on:click="minYear = 1; maxYear = new Date().getFullYear()" class="underline cursor-pointer text-blueGray-300">
                    Reset filter
                </span>
            </span>
        </div>
            <div class="flex flex-1 w-full">
                <input name="searchinput" id="searchinput" wire:model.debounce.300ms="search"
                :placeholder="searchtype == 'anime' ? 'Type to search an ' + searchtype : 'Type to search a ' + searchtype"
                type="search" class="flex-1 h-12 my-3 input" />
                <span class="flex items-center justify-center my-3">
                    {{-- <label class="m-1 text-xs" for="searchtype">Type</label> --}}
                    <select class="p-2 select bg-blueGray-900" wire:model="searchtype" name="searchtype" id="searchtype">
                        @foreach(\App\Models\Status::all() as $status)
                        <option class="select-option" value="{{ $status->type }}">{{ ucfirst($status->type) }}s</option>
                        @endforeach
                    </select>
                </span>
            </div>

            </div>

        <div wire:loading.delay class="loader" style="position: fixed; left: 50%; top: 8%">
        </div>

        <div x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100" x-show="searchResponse"
            class="flex flex-wrap items-center justify-center w-full mt-4">

            @if ($searchResponse && count($searchResponse) > 0)

                @foreach ($searchResponse->unique() as $item)
                @if($item["type"] != "game")
                <span style="height: 40rem;" class="flex justify-center p-5 mx-10 my-4 overflow-hidden shadow-xl min-w-5/6 text-blueGray-300 md:w-1/4 lg:w-1/5 rounded-xxxl border-blueGray-300"
                x-show="filterByYear('{{ $item['year'] }}')">
                    <livewire:result :item="$item" :searchtype="$searchtype" :key="$item['id']" />
                </span>
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