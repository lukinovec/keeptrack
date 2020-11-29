<div class="text-blueGray-300 mx-10 my-4 p-5 w-5/6 md:w-1/4 lg:w-1/5 rounded-xxxl item shadow-xl border-t-2 border-b-2 border-blueGray-300"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90">
    <span class="text-2xl font-bold">
        {{ $item["title"] }}
    </span>

    {{ $item["year"] }}
    <div id="'{{ $item['id'] }}'" class="flex justify-center">
        <img class="my-2 rounded-xxxl" src="{{ $item['image'] }}" alt="image">
    </div>
    <div class="info flex font-bold">
        @if ($searchtype == "movie")
        <a class="btn h-10 border-none text-center" href="https://www.imdb.com/title/{{ $item["id"] }}/"
            target="_blank">
            <img class="h-full" src="{{ asset('images/imdb.png') }}" alt="IMDb">
        </a>
        @elseif($searchtype == "book")
        <a class="flex-1 btn text-center" href="https://www.goodreads.com/book/show/{{ $item["id"] }}" target="_blank">
            See on Goodreads
        </a>
        @endif
        <select x-data='{ statuses: @json($statuses), item_status: @json($item).status }'
            class="text-center select overflow-hidden bg-blueGray-800 flex-1"
            :class="{ 'bg-green-900': item_status !== '' && item_status !== 'none' }" wire:model="item.status">
            <option class="bg-blueGray-800" value="none" x-text="statuses.none"></option>
            <option class="bg-blueGray-800" value="completed" x-text="statuses.completed"></option>
            <option class="bg-blueGray-800" value="ptw" x-text="statuses.ptw"></option>
            @if ($item["type"] !== "movie")
            <option class="bg-blueGray-800" value="watching" x-text="statuses.watching"></option>
            @endif
        </select>
    </div>
</div>