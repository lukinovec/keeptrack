@extends('livewire.library')
@section('movies')
<div class="flex flex-row flex-wrap text-center justify-center md:mx-24">
    @foreach ($library as $item)
    <div class="my-10 flex justify-center p-5 w-full sm:w-1/2 lg:w-1/3" id="{{ $item['apiID'] }}">
        <div class="item relative text-white w-5/6">
            <div class="w-full bg-gray-700">
                <img src="{{ $item['image'] }}" class="w-full select-none transition-opacity duration-300"
                    :class="{ 'opacity-25': edit.apiID == {{ json_encode($item) }}.apiID }" alt="Image not found">
                <span
                    x-on:click="edit.apiID == {{ json_encode($item) }}.apiID ? edit = false : edit = {{ json_encode($item) }}"
                    class="absolute top-0 right-0 m-2 p-2 bg-black rounded-lg sm:w-8 w-12 transform duration-300 sm:hover:scale-125"
                    :class="{ 'sm:scale-125 bg-white': edit.apiID == {{ json_encode($item) }}.apiID }">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-edit w-full">
                        <path class="primary" fill="#718096"
                            d="M4 14a1 1 0 0 1 .3-.7l11-11a1 1 0 0 1 1.4 0l3 3a1 1 0 0 1 0 1.4l-11 11a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-3z" />
                        <rect fill="#718096" width="20" height="2" x="2" y="20" class="secondary" rx="1" /></svg>
                </span>
                <div class="title absolute text-xl w-full bottom-auto bg-gray-700 p-3">
                    {{ $item['name'] }}
                    @if ($item["type"] != "movie")
                    <div class="text-sm">
                        <label for="seasons">Season</label>
                        <select class="w-12 bg-black bg-opacity-25" x-model.number="{{ json_encode($item) }}.season"
                            id="seasons" name="seasons">
                            @foreach ($item["seasons"] as $season)
                            <option value="{{$season['number']}}" x-text="{{ $season['number'] }}"></option>
                            @endforeach
                        </select>
                        <label for="episodes">Episode</label>
                        <input name="episodes" class="w-8 border-b-2 bg-black bg-opacity-25"
                            x-model.number="{{ json_encode($item) }}.episode" type="text">
                        / <span
                            x-text="({{ json_encode($item) }}.seasons[{{ json_encode($item) }}.season-1].episodes.Episodes).length"></span>
                        <button x-on:click="{{ json_encode($item) }}.episode+=1">+</button>
                    </div>
                    <button class="w-full focus:outline-none text-base py-1 mt-2 hover:bg-gray-900"
                        x-on:click="$wire.set('progress', item)">Submit</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection