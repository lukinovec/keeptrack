<div class="flex flex-col justify-between p-5 mx-10 my-4 overflow-hidden border-t-2 border-b-2 shadow-xl min-w-5/6 text-blueGray-300 md:w-1/4 lg:w-1/5 rounded-xxxl item border-blueGray-300"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
    style="height: 40rem;">

    <section class="text-lg">
        <span class="font-bold">{{ $result["title"] }}</span> {{ $result["year"] }}
    </section>

    @if ($message)
    <div class="flex items-center justify-center text-lg font-bold text-blueGray-300" style="position: fixed; left: 50%; top: 15%">
        <span class="relative p-4 bg-green-600 rounded-xxl" style="left: -50%">
            {{ $message }}
        </span>
    </div>
    @endif

    @if($result['image'] != "N/A")
    <img class="my-2 rounded-xxxl" src="{{ $result['image'] }}" alt="Image not available">
    @else
    <h1>Image not available</h1>
    @endif
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
            class="flex-1 h-8 overflow-hidden text-center select bg-blueGray-900"
            {{-- :class="{ 'bg-green-900': resultStatus !== '' && resultStatus !== 'none' }" --}}
            wire:model="resultStatus" x-model="resultStatus">
            <option value="none" class="bg-blueGray-800" x-text="resultStatus === 'none' || resultStatus === '' ? 'Select status' : statuses[resultStatus]" selected hidden></option>
            <option class="bg-blueGray-800" value="completed" x-text="statuses.completed"></option>
            <option class="bg-blueGray-800" value="ptw" x-text="statuses.ptw"></option>
            @if ($result["type"] !== "movie")
            <option class="bg-blueGray-800" value="watching" x-text="statuses.watching"></option>
            @endif
            <option x-show="resultStatus !== '' && resultStatus !== 'none'" value="none" class="bg-blueGray-800">Remove</option>
        </select>
    </section>
</div>