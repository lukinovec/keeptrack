<div x-data="{ filter: [], status_filter: [], favorite_only: false, filter_hidden: false, search: '',
    clearFilters: function() {
        this.filter = [];
        this.status_filter = [];
        this.favorite_only = false;
    }
}" @item-updated="clearFilters()" class="w-full h-full">
    <div wire:loading wire:target='updateItem' class="z-50 loader" style="position: fixed; left: 50%; top: 8%"></div>

    @if ($errors->any())
            @foreach ($errors->all() as $error)
            <x-flash-message :message="$error" />
            @endforeach
    @endif

    {{-- Library Searchbar --}}

    @if ($library->count() > 0)
    <div x-cloak class="flex flex-col items-center w-full text-center select-none">
        <div class="p-1 m-2 text-lg font-bold text-center text-blueGray-300">
            Library filter
            <span class="ml-2 underline cursor-pointer text-blueGray-500 hover:text-blueGray-400" x-on:click="filter_hidden = !filter_hidden" x-text="filter_hidden ? 'Show' : 'Hide'"></span>
        </div>

        <section x-show="!filter_hidden" class="w-full">
            <input x-model="search" placeholder="Search in library" type="search"
            class="w-full sm:w-2/3 input" />
            <div class="flex flex-wrap items-center justify-center pt-4 space-x-8 text-lg text-blueGray-300">
                @if ($library->contains("is_favorite", true))
                <span class="flex space-x-2">
                    <input x-model="favorite_only" type="checkbox" id="filter_favorite" name="filter_favorite" value="true">
                    <label  for="filter_favorite">Only favorites</label>
                </span>
                @endif
                <span class="flex flex-col items-start justify-start">
                    @foreach ($library->unique("type") as $unique)
                    <span class="flex space-x-2">
                        <input x-model="filter" type="checkbox" id="{{ $unique["type"] }}" name="filter_type" value="{{ $unique["type"] }}">
                        <span class="flex items-center justify-center space-x-2">
                            <label class="flex items-center justify-center" for="{{ $unique["type"] }}">{{ ucfirst($unique["type"]) }}
                                <span class="flex text-sm text-blueGray-600">
                                    <img class="w-3 mx-1" src="{{ asset(\App\Models\Status::where("type", $unique["searchtype"])->first()->image) }}" alt="Searchtype image">
                                    {{ ucfirst($unique["searchtype"]) }}
                                </span>
                            </label>
                        </span>
                    </span>
                    @endforeach
                </span>

                <span class="flex flex-col items-start justify-start">
                    @foreach ($library->unique("status") as $unique)
                    <span class="flex space-x-2">
                        <input x-model="status_filter" type="checkbox" id="{{ $unique["status"] }}" name="filter_status" value="{{ $unique["status"] }}">
                        <label  for="{{ $unique["status"] }}">{{ ucfirst(str_replace('_', ' ', $unique["status"])) }}</label>
                    </span>
                    @endforeach
                </span>
                    <span class="ml-2 font-bold underline cursor-pointer text-blueGray-500 hover:text-blueGray-400" x-on:click="clearFilters()">Remove filters</span>
                </div>
            </section>

            <section id="order_by" class="flex space-x-3" x-data="{ ratingDesc: @entangle('ratingDesc'), nameAsc: @entangle('nameAsc') }">
                <span class="flex space-x-2 cursor-pointer text-blueGray-300" x-on:click="sortBy('rating', ratingDesc)">
                    <img class="fill-current" src="{{ asset("images/chevron-down.svg") }}" alt="chevron">
                    <h3>Rating</h3>
                </span>
                <span class="flex space-x-2 cursor-pointer text-blueGray-300" x-on:click="sortBy('name', nameAsc)">
                    <img class="fill-current" src="{{ asset("images/chevron-down.svg") }}" alt="chevron">
                    <h3>Alphabet</h3>
                </span>
            </section>
    </div>

        <div x-ref="items" class="flex flex-row flex-wrap justify-center text-center md:mx-24">
            @foreach ($library as $item)
            <template class="{{ $item["item_id"] }}"
            x-if="((filter.includes('{{ $item["type"] }}') || filter.length === 0)
            && (status_filter.includes('{{ $item["status"] }}') || status_filter.length === 0)
            && (favorite_only ? {{ $item["is_favorite"] }} : true))
            && ('{{ $item["name"] }}'.toLowerCase().includes(search) || search == null)"
             :key="$item.item_id">
            <div x-data='{
                    item: @json($item),
                    edit: false,
                    removeConfirmation: {
                        accepted: false,
                        item: {}
                    },
                    editButton: function(item) {
                        this.removeConfirmation.item = {};
                        if(item.apiID == this.edit.apiID) {
                            this.edit = false;
                        } else {
                            this.edit = item;
                        }
                    },

                    favorite: function(item) {
                        this.item.is_favorite = !item.is_favorite;
                        this.$wire.updateItem(this.item, "favorite");
                    },

                    submit: function(item) {
                        this.$wire.updateItem(item);
                        this.edit = false;
                    },

                    remove: function(item) {
                        edit = false;
                        if(Object.keys(this.removeConfirmation.item).length === 0) {
                            this.removeConfirmation.item = item;
                        } else {
                            this.removeConfirmation.item = {};
                        }
                    },

                    confirmRemove: function(confirmed) {
                        if(confirmed) {
                            this.item.status = "none";
                            this.$wire.updateItem(this.item, "remove");
                            setTimeout(function() {
                                window.location.reload();
                            }, 250);
                        } else {
                            this.removeConfirmation.item = {};
                        }
                    },

                    nextEpisode: function() {
                        if(typeof this.item.progress.seasons[this.item.user_progress.season] !== "undefined") {
                            if(this.item.user_progress.episode > (this.item.progress.seasons[this.item.user_progress.season-1].episodes.Episodes).length) {
                                this.item.user_progress.season += 1;
                                this.item.user_progress.episode = 1;
                            } else if(this.item.user_progress.episode < 1) {
                                if(this.item.user_progress.season === 1) {
                                    this.item.user_progress.episode = 1;
                                } else {
                                    this.item.user_progress.season -= 1;
                                    this.item.user_progress.episode = (this.item.progress.seasons[this.item.user_progress.season-1].episodes.Episodes).length;
                                }
                            }
                        }
                    }
                }' class="flex justify-center w-full p-5 my-10 lg:w-1/2 xl:w-1/3" :key="item.item_id">
            <x-library-item :item="$item" />
        </div>
        </template>
        @endforeach
        <span x-show="!$refs.items.getElementsByTagName('div')[0]" class="m-20 font-bold">No items</span>
    </div>
    @else
    <div wire:loading.remove class="w-full mt-40 text-2xl text-center">
        <span class="font-bold">
            No items in your library
        </span><br>
        <p>
            You can <a href="/home" class="underline">search</a> for an item, then click on a status and it will appear here.
        </p>
    </div>
    @endif
</div>