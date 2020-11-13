<div class="h-full w-full">
    <div class="fixed bg-black bg-opacity-50 rounded-lg p-4 text-white left-0 right-0 mx-auto text-center"
        style="width: 100px" wire:loading wire:target='updateItem'>
        <img src="{{ asset('images/loading.gif') }}" alt="Loading gif">
        Updating item, please wait...
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if ($library->count() > 0 && $type === "movies" || $type === "series" || $type === "tv")
    <div class="flex flex-row flex-wrap text-center justify-center md:mx-24">
        @foreach ($library as $item)
        <div x-data='{
            item: @json($item),
            statuses: @json($statuses),
            edit: false,
            editButton: function(item) {
                if(item.apiID == this.edit.apiID) {
                    this.edit = false;
                } else {
                    this.edit = item;
                }
            },
            getEpisodes: function(item) {
                item.episodes = item.seasons ? (item.seasons[item.season-1].episodes.Episodes).length : item.episodes;
            }
        }' class="my-10 flex justify-center p-5 w-full sm:w-1/2 lg:w-1/3" :id="item.apiID">
            <div class="item relative text-white w-5/6">
                <div class="w-full bg-gray-700">
                    <img :src="item.image" class="w-full select-none transition-opacity duration-300"
                        :class="{ 'opacity-25': edit.apiID == item.apiID }" alt="Image not found">
                    <div class="absolute w-full h-full pb-32 sm:pb-56 flex flex-col text-left"
                        x-show="edit.apiID == item.apiID" style="z-index: 999; top: 25%">
                        <br>
                        <span class="flex-1 mx-3">
                            Rating: <input class="w-6 edit" x-model.number="item.rating" type="text" name="rating">/10
                        </span>
                        <span class="flex-1 mx-3">
                            Note: <input class="edit w-5/6" x-model="item.note" type="text">
                        </span>
                        <br>
                        <span class="flex-1 mx-3">
                            Status: <select class="edit w-32" x-model="item.status" name="status">
                                <template x-for="status in statuses">
                                    <option :value="status" x-text="status"></option>
                                </template>
                            </select>
                        </span>
                        <span class="flex-1">
                            @if ($item['type'] != "movie")
                            <div class="mx-3" x-show="item.apiID == edit.apiID" style="z-index: 999">
                                <div class="text-sm">
                                    @if($item['type'] == 'series')
                                    <label for="seasons">Season</label>
                                    <select class="w-12 bg-black bg-opacity-25" x-model.number="item.season"
                                        id="seasons" name="seasons">
                                        <template x-for="season in item.seasons">
                                            <option x-model="season.number" value="season.number"
                                                x-text="season.number"></option>
                                        </template>
                                    </select>
                                    <br class="my-2">
                                    @endif
                                    <label for="episodes">Episode</label>
                                    <input name="episodes" class="w-8 border-b-2 bg-black bg-opacity-25"
                                        x-model.number="item.episode" type="text">
                                    /
                                    <span
                                        x-text="item.seasons ? (item.seasons[item.season-1].episodes.Episodes).length : item.episodes"></span>

                                    <button x-on:click="item.episode++">+</button>
                                </div>
                            </div>
                            @endif
                        </span>
                        <button
                            class="w-1/4 rounded-lg focus:outline-none text-base py-1 mt-2 mx-auto bg-gray-700 hover:bg-gray-900"
                            x-show="edit.apiID == item.apiID" x-on:click="$wire.updateItem(item)">
                            Submit
                        </button>
                    </div>

                    {{-- Edit button --}}
                    <span x-on:click="editButton(item)"
                        class="absolute top-0 right-0 m-2 p-2 bg-black rounded-lg sm:w-8 w-12 transform duration-300 sm:hover:scale-125"
                        :class="{ 'sm:scale-125 bg-white': edit.apiID == item.apiID }">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-edit w-full">
                            <path class="primary" fill="#718096"
                                d="M4 14a1 1 0 0 1 .3-.7l11-11a1 1 0 0 1 1.4 0l3 3a1 1 0 0 1 0 1.4l-11 11a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-3z" />
                            <rect fill="#718096" width="20" height="2" x="2" y="20" class="secondary" rx="1" /></svg>
                    </span>
                    {{-- Submit button --}}
                    <div class="title absolute text-xl w-full bottom-auto bg-gray-700 p-3" x-text="item.name"></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Books --}}

    @elseif($library->count() > 0 && $type === "books")
    <div class="flex flex-row flex-wrap text-center justify-center md:mx-24">
        @foreach ($library as $item)
        <div x-data="{ item: item }" class="my-10 flex justify-center p-5 w-full sm:w-1/6" id="{{ $item['apiID'] }}">
            <div class="item relative text-white w-5/6">
                <div class="w-full">
                    <img src="{{ $item['image'] }}" class="w-full" alt="Image not found">
                    <div class="title absolute text-xl w-full bottom-auto bg-black bg-opacity-75 sm:bg-opacity-100 p-3">
                        {{ $item['name'] }}
                    </div>
                    <div class="text-sm">
                        <label for="pages">Pages Read</label>
                        <input name="pages" x-model="pages" type="text">
                        {{-- <select class="w-12 bg-black bg-opacity-25" x-model.number="item.season"
                        id="seasons" name="seasons">
                        @foreach ($item["seasons"] as $season)
                        <option value="{{$season['number']}}" x-text="{{ $season['number'] }}"></option>
                        @endforeach
                        </select>
                        <label for="episodes">Episode</label>
                        <input name="episodes" class="w-8 border-b-2 bg-black bg-opacity-25"
                            x-model.number="item.episode" type="text">
                        / <span x-text="(item.seasons[item.season-1].episodes.Episodes).length"></span>
                        <button x-on:click="item.episode+=1">+</button> --}}
                    </div>
                    {{-- <button class="w-full focus:outline-none text-base py-1 mt-2 hover:bg-gray-900"
                        x-on:click="$wire.set('progress', item)">Submit</button> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <div wire:loading.remove class="mt-40 text-2xl w-full text-center">
        <span class="font-bold">
            No items in your library
        </span><br>
        You can search for {{ $type }}, then click on a status and the {{ $type }} will appear here.
    </div>
    @endif
</div>