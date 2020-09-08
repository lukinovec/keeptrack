<div>
    @foreach ($show as $result)
    <div class="result">
        @if ($result->searchType === 'movie')
        <img :src="result->Poster" alt="poster" />
        <h1>{{ $result->Title }}</h1>
        @else
        {{ $result }}
        @endif
    </div>
    @endforeach
</div>