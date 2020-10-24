<div class="h-full w-full flex flex-row flex-wrap text-center justify-center md:mx-24">
    @foreach ($library as $item)
    <div x-data="{ item: {{ json_encode($item) }} }" class="my-10 flex justify-center p-5 w-full sm:w-1/2 lg:w-1/3"
        id="{{ $item['imdbID'] }}">
        <div class="item relative text-white w-full">
            <div class="w-full">
                <img src="{{ $item['image'] }}" class="w-full" alt="">
                <div class="title text-xl w-full bg-black bg-opacity-75 sm:bg-opacity-100 p-3"
                    style="position: absolute; bottom: 0px;">
                    {{ $item['name'] }}
                    @if ($item["type"] != "movie")
                    <div class="text-sm">
                        <label for="seasons">Season</label>
                        <select class="w-12 bg-black bg-opacity-25" x-model.number="item.season" id="seasons"
                            name="seasons">
                            @foreach ($item["seasons"] as $season)
                            <option value="{{$season['number']}}" x-text="{{$season['number']}}"></option>
                            @endforeach
                        </select>
                        <label for="episodes">Episode</label>
                        <input name="episodes" class="w-8 border-b-2 bg-black bg-opacity-25"
                            x-model.number="item.episode" type="text">
                        / <span x-text="(item.seasons[item.season-1].episodes).length"></span>
                        <button x-on:click="item.episode+=1">+</button>
                    </div>
                    <button class="w-full text-base py-1 mt-2 hover:bg-gray-900"
                        x-on:click="$wire.set('progress', item)">Submit</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>