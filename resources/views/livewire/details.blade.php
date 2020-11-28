<div class="flex mx-5 rounded-xxxl bg-blueGray-900 p-6 text-blueGray-300">
    <div class="flex flex-1 flex-col">
        @if ($type != "book")
        <div class="flex space-x-16">
            <div class="flex space-x-8">
                <span>{{ $details["Released"] }}</span>
                <span>{{ $details["Genre"] }}</span>
                <span>{{ $details["Runtime"] }}</span>
            </div>
            <div class="flex">
                <a href="https://www.imdb.com/title/{{ $details["imdbID"] }}/" target="_blank">
                    <img src="{{ asset('images/imdb.png') }}" width="64px" alt="IMDb">
                </a>
                <span class="mx-2">{{ $details["imdbRating"] }}/10</span>
            </div>
        </div>
        @endif
        <hr class="text-blueGray-300 m-1 my-3">
        <div class="flex flex-col mt-5 space-y-1 font-bold">
            @if ($details["Director"] == "N/A")
            <span>Directed by {{ $details["Writer"] }}</span>
            @else
            <span>Directed by {{ $details["Director"] }}</span>
            <span>Written by {{ $details["Writer"] }}</span>
            @endif
        </div>
        <span class="mt-20 text-lg">{{ $details["Plot"] }}</span>
    </div>
</div>