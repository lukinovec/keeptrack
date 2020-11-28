<div class="flex flex-col mx-5 rounded-xxxl bg-blueGray-900 p-6 text-blueGray-300">
    <div class="flex flex-col mt-5 space-y-1 font-bold">
        @if (isset($details["authors"]->author->link))
        <a href="{{ $details["authors"]->author->link }}" target="_blank" class="flex-1">
            Written by {{ $details["authors"]->author->name }}
        </a>
        @else
        <span class="flex-1">Written by {{ $details["authors"]->author->name }}</span>
        @endif
        <a href="https://www.goodreads.com/book/show/{{ $details["id"] }}" target="_blank">
            See book on Goodreads
        </a>
    </div>
    <span class="mt-20 text-lg">{!! $details["description"] !!}</span>
</div>