<div class="h-full w-full">

    <div wire:loading wire:target='updateItem' class="loader" style="position: fixed; left: 50%; top: 7%"></div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if ($library->count() > 0)
    {{-- Library Searchbar --}}
    <div class="flex-1 text-center">
        <input wire:model.debounce.300ms="search" placeholder="Search {{ $type }}s in library" type="search"
            class="input" />
    </div>
    <div class="flex flex-row flex-wrap text-center justify-center md:mx-24">
        @foreach ($library->sortByDesc('updated_at') as $item)
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
                    submit: function(item) {
                        $wire.updateItem(item);
                        this.edit = false;
                    },
                }' class="my-10 flex justify-center p-5 w-full sm:w-1/2 lg:w-1/3" :id="item.apiID">
            <div class="item relative text-white w-5/6">
                <div class="w-full bg-gray-700 shadow-xl rounded-xxxl">
                    <img :src="item.image" class="w-full rounded-xxxl select-none transition-opacity duration-300"
                        :class="{ 'opacity-25': edit.apiID == item.apiID }" alt="Image not found">
                    <div class="title absolute text-xl w-full top-0 rounded-t-xxxl bg-gradient-to-b from-blueGray-700 to-transparent p-2"
                        x-text="item.name">
                    </div>
                    {{-- Edit --}}
                    <div class="absolute w-full h-full pb-32 sm:pb-64 flex flex-col text-left"
                        x-show="edit.apiID == item.apiID" style="z-index: 999; top: 25%">
                        <br>
                        <span class="flex flex-1 mx-3">
                            <span class="flex-1">
                                <span class="text-sm">
                                    Rating
                                </span> <br>
                                <input maxlength="2" class="w-12 input text-lg" x-model.number="item.rating" type="text"
                                    name="rating"> /
                                10
                            </span>
                            <span class="flex-1 mx-3">
                                <x-status-component><span class="text-sm">
                                        Status</span><br> </x-status-component>
                            </span>
                        </span>
                        <span class="flex-1 mx-3">
                            <span class="text-sm">Note</span> <br>
                            <input class="input w-5/6" x-model="item.note" type="text">
                        </span>
                        <br>

                        <span class="flex-1">
                            @if ($item['type'] != "movie")
                            <div class="mx-3" x-show="item.apiID == edit.apiID" style="z-index: 999">
                                <div>
                                    @if($item['type'] == 'series')
                                    <label for="seasons">Season</label>
                                    <select class="w-12 bg-black select bg-opacity-25" x-model.number="item.season"
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
                        <button class="btn w-1/4 mx-auto" x-show="edit.apiID == item.apiID"
                            x-on:click="$wire.updateItem(item)">
                            Submit
                        </button>
                    </div>
                    {{-- Edit button --}}
                    <x-edit-button />


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
        You can search for a {{ $type }}, then click on a status and the {{ $type }} will appear here.
    </div>
    @endif
</div>