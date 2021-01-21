<div class="relative flex flex-col justify-between w-5/6 p-5 mx-10 my-4 overflow-hidden border-t-2 border-b-2 shadow-xl text-blueGray-300 md:w-1/4 lg:w-1/5 rounded-xxxl item border-blueGray-300"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
    style="height: 40rem;">

    <section class="text-lg">
        <span class="font-bold">{{ $result["title"] }}</span> {{ $result["year"] }}
    </section>

    <img class="flex-1 my-2 rounded-xxxl" src="{{ $result['image'] }}" alt="image">

    <section class="flex p-2 font-bold info">
        @if ($searchtype == "movie")
        <a class="h-8 text-center border-none btn" href="https://www.imdb.com/title/{{ $result["id"] }}/" target="_blank">
            <img class="h-full" src="{{ asset('images/imdb.png') }}" alt="IMDb">
        </a>
        @elseif($searchtype == "book")
        <a class="flex-1 h-8 text-center btn" href="https://www.goodreads.com/book/show/{{ $result["id"] }}"
            target="_blank">
            See on Goodreads
        </a>
        @endif
        <select x-data='{ statuses: @json($statuses), resultStatus: @json($result).status }'
            class="flex-1 h-8 overflow-hidden text-center select bg-blueGray-800"
            {{-- :class="{ 'bg-green-900': resultStatus !== '' && resultStatus !== 'none' }" --}}
            wire:model="resultStatus">
            <option value="none" class="bg-blueGray-800" x-text="resultStatus === 'none' || resultStatus === '' ? 'Select an Option' : statuses[resultStatus]" selected hidden></option>
            <option class="bg-blueGray-800" value="completed" x-text="statuses.completed"></option>
            <option class="bg-blueGray-800" value="ptw" x-text="statuses.ptw"></option>
            @if ($result["type"] !== "movie")
            <option class="bg-blueGray-800" value="watching" x-text="statuses.watching"></option>
            @endif
        </select>
    </section>
</div>