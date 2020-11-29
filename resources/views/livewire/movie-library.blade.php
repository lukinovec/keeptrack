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

    {{-- Library Searchbar --}}
    <div class="flex flex-col flex-1 items-center">
        <input wire:model.debounce.300ms="search" placeholder="Search {{ $type }}s in library" type="search"
            class="input w-56" />
        <div class="flex filter mt-4 space-x-2">
            <span>
                <select wire:model="filter"
                    class="text-center select bg-transparent border-2 border-r-0 text-blueGray-500 text-lg border-blueGray-500 w-40"
                    name="filter" id="filter">
                    <option class="bg-blueGray-900" value="none">
                        All
                    </option>
                    <option class="bg-blueGray-900" value="completed">
                        {{ $statuses['completed'] }}
                    </option>
                    <option class="bg-blueGray-900" value="ptw">
                        {{ $statuses['ptw'] }}
                    </option>
                    <option class="bg-blueGray-900" value="watching">
                        {{ $statuses['watching'] }}
                    </option>
                    <option class="bg-blueGray-900" value="favorite">
                        Only favorites
                    </option>
                </select>
                <button for="filter" wire:click='updatedFilter("none")' class="mx-2 btn text-blueGray-500
border-blueGray-500 p-1 text-sm">Remove
                    Filter</button>
            </span>
        </div>
    </div>
    @if ($library->count() > 0)
    <div class="flex flex-row flex-wrap text-center justify-center md:mx-24">
        @foreach ($library->sortByDesc('updated_at')->sortByDesc('is_favorite') as $item)
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
                    favoriteButton: function(item) {
                        this.item.is_favorite = !this.item.is_favorite;
                        $wire.favoriteItem(this.item);
                    },
                    submit: function(item) {
                        $wire.updateItem(item);
                        this.edit = false;
                    },
                }' class="my-10 flex justify-center p-5 w-full md:2/3 lg:w-1/2 xl:w-1/3" :id="item.apiID">
            <div class="item relative text-white w-5/6">
                <div class="w-full bg-gray-700 shadow-xl rounded-xxxl">
                    <img :src="item.image" class="w-full rounded-xxxl select-none transition-opacity duration-300"
                        :class="{ 'opacity-25': edit.apiID == item.apiID }" alt="Image not found">
                    <div class="title absolute text-xl w-full top-0 rounded-t-xxxl bg-gradient-to-b from-blueGray-700 to-transparent p-2"
                        x-text="item.name">
                    </div>
                    {{-- Edit --}}
                    <div class="absolute w-full h-full top-0 flex flex-col justify-evenly text-left"
                        x-show="edit.apiID == item.apiID">
                        <span class="justify-center mx-8">
                            <span class="text-sm">
                                Rating
                            </span> <br>
                            <input maxlength="2" class="w-8 border-b-2 bg-black bg-opacity-25 text-lg"
                                x-model.number="item.rating" type="text" name="rating"> /
                            10
                        </span>

                        <span class="mx-8">
                            <x-status-component><span class="text-sm">
                                    Status</span><br> </x-status-component>
                        </span>

                        @if ($item['type'] != "movie")
                        <div class="mx-8" x-show="item.apiID == edit.apiID" style="z-index: 999">
                            <div>
                                @if($item['type'] == 'series')
                                <label for="seasons">Season</label><br>
                                <select class="w-12 bg-black select bg-opacity-25" x-model.number="item.season"
                                    id="seasons" name="seasons">
                                    <template x-for="season in item.seasons">
                                        <option class="bg-blueGray-700 text-blueGray-300" x-model="season.number"
                                            value="season.number" x-text="season.number">
                                        </option>
                                    </template>
                                </select>
                                <br><br>
                                @endif
                                <label for="episodes">Episode</label><br>
                                <input name="episodes" class="w-8 border-b-2 bg-black bg-opacity-25"
                                    x-model.number="item.episode" type="text">
                                /
                                <span
                                    x-text="item.seasons ? (item.seasons[item.season-1].episodes.Episodes).length : item.episodes"></span>

                                <button x-on:click="item.episode++">+</button>
                            </div>
                        </div>
                        @endif

                        <span class="mx-8">
                            <span class="text-sm">Note</span> <br>
                            <input placeholder="Take a note about this {{ $type }}" class="input w-full"
                                x-model="item.note" type="text">
                        </span>

                        <button class="btn w-1/4 mx-auto" x-show="edit.apiID == item.apiID"
                            x-on:click="$wire.updateItem(item)">
                            Submit
                        </button>
                    </div>

                    {{-- Edit button --}}

                    <button x-on:click="editButton(item)"
                        class="absolute right-0 m-2 p-2 bg-black rounded-xxxl sm:w-8 w-12 transform duration-300 sm:hover:scale-125 z-50"
                        :class="{ 'sm:scale-125 bg-blueGray-400   00': edit.apiID == item.apiID }"
                        style="top: 2.5rem; right: 1rem">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-edit w-full">
                            <path class="primary" fill="rgba(226, 232, 240)"
                                d="M4 14a1 1 0 0 1 .3-.7l11-11a1 1 0 0 1 1.4 0l3 3a1 1 0 0 1 0 1.4l-11 11a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-3z" />
                            <rect fill="rgba(226, 232, 240)" width="20" height="2" x="2" y="20" class="secondary"
                                rx="1" /></svg>
                    </button>

                    {{-- Favorite button --}}
                    <button x-on:click="favoriteButton(item)"
                        class="absolute right-0 m-2 p-2 bg-black rounded-xxxl w-8 transform duration-300 sm:hover:scale-125 z-50"
                        :class="{ 'bg-yellow-600': item.is_favorite }" style="top: 6rem; right: 1rem">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon-star w-full">
                            <path class="secondary" fill="rgba(226, 232, 240)"
                                d="M9.53 16.93a1 1 0 0 1-1.45-1.05l.47-2.76-2-1.95a1 1 0 0 1 .55-1.7l2.77-.4 1.23-2.51a1 1 0 0 1 1.8 0l1.23 2.5 2.77.4a1 1 0 0 1 .55 1.71l-2 1.95.47 2.76a1 1 0 0 1-1.45 1.05L12 15.63l-2.47 1.3z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div wire:loading.remove class="mt-40 text-blueGray-300 text-2xl w-full text-center">
        <span class="font-bold">
            No items in your library
        </span><br>
        You can search for a {{ $type }}, then click on a status and the {{ $type }} will appear here.
    </div>
    @endif
</div>