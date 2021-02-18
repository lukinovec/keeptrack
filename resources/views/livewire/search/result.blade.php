<div class="flex flex-col items-center justify-between py-4 item"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
    style="height: 40rem;">

    <section class="text-lg">
        <span class="font-bold">{{ $result["title"] }}</span> {{ $result["year"] }}
    </section>

    @if ($message)
    <x-flash-message :message="$message" />
    @endif

    @if($result['image'] != "N/A")
    <img class="my-2 rounded-xxxl max-h-3/4" src="{{ $result['image'] }}" alt="Image not available">
    @else
    <h1>Image not available</h1>
    @endif
    <section class="flex items-center justify-center w-full p-2 my-2 font-bold info">
        @if ($searchtype == "movie")
        <a class="h-8 text-center border-none btn" href="https://www.imdb.com/title/{{ $result["id"] }}/" target="_blank">
            <img class="h-full" src="{{ asset('images/imdb.png') }}" alt="IMDb link">
        </a>
        @elseif($searchtype == "book")
        <a class="flex-1 h-8 text-center btn" href="https://www.goodreads.com/book/show/{{ $result["id"] }}"
            target="_blank">
            Details
        </a>
        @endif
        <select x-data='{ statuses: @json($statuses), resultStatus: @json($result).status }'
            class="flex-1 h-8 overflow-hidden text-center select bg-blueGray-900"
            {{-- :class="{ 'bg-green-900': resultStatus !== '' && resultStatus !== 'none' }" --}}
            wire:model="resultStatus" x-model="resultStatus">
            <option value="none" class="bg-blueGray-800" x-text="resultStatus === 'none' || resultStatus === '' ? 'Select status' : statuses[resultStatus]" selected hidden></option>
            <option class="bg-blueGray-800" value="completed" x-text="statuses.completed"></option>
            <option class="bg-blueGray-800" value="planning" x-text="statuses.planning"></option>
            @if ($result["type"] !== "movie")
            <option class="bg-blueGray-800" value="in_progress" x-text="statuses.in_progress"></option>
            @endif
            <option x-show="resultStatus !== '' && resultStatus !== 'none'" value="none" class="bg-blueGray-800">Remove</option>
        </select>
    </section>
</div>