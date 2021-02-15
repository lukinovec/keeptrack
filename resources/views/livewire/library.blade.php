<div x-data="{ filter: [], status_filter: [], favorite_only: false, filter_hidden: false,
    clearFilters: function() {
        this.filter = [];
        this.status_filter = [];
        this.favorite_only = false;
    },
}" @item-updated="clearFilters()" class="w-full h-full">

    <div wire:loading wire:target='updateItem' class="z-50 loader" style="position: fixed; left: 50%; top: 8%"></div>

    @if ($errors->any())
            @foreach ($errors->all() as $error)
            <x-flash-message :message="$error" />
            @endforeach
    @endif

    {{-- Library Searchbar --}}
    <div class="flex flex-col items-center w-full text-center select-none">
        <div class="p-1 m-2 text-lg font-bold text-center text-blueGray-300">
            Library filter
            <span class="ml-2 underline cursor-pointer text-blueGray-500 hover:text-blueGray-400" x-on:click="filter_hidden = !filter_hidden" x-text="filter_hidden ? 'Show' : 'Hide'"></span>
        </div>

        <section x-show="!filter_hidden" class="w-full">
            <input wire:model.debounce.300ms="search" placeholder="Search in library" type="search"
            class="w-full sm:w-2/3 input" />
            <div class="flex flex-wrap items-center justify-center pt-2 space-x-5 text-lg text-blueGray-300">
                @foreach ($library->unique("type") as $unique)
                <span>
                    <input x-model="filter" type="checkbox" id="{{ $unique["type"] }}" name="filter_type" value="{{ $unique["type"] }}">
                    <label for="{{ $unique["type"] }}">{{ ucfirst($unique["type"]) }}</label>
                </span>
                @endforeach
                <span>
                    <input x-model="favorite_only" type="checkbox" id="filter_favorite" name="filter_favorite" value="true">
                    <label for="filter_favorite">Only favorites</label>
                </span>

                @foreach ($library->unique("status") as $unique)
                <span>
                    <input x-model="status_filter" type="checkbox" id="{{ $unique["status"] }}" name="filter_status" value="{{ $unique["status"] }}">
                    <label for="{{ $unique["status"] }}">{{ ucfirst(str_replace('_', ' ', $unique["status"])) }}</label>
                </span>
                @endforeach

                <span class="ml-2 font-bold underline cursor-pointer text-blueGray-500 hover:text-blueGray-400" x-on:click="clearFilters()">Remove filters</span>
            </div>
        </section>
    </div>

        @if ($library->count() > 0)
        <div x-ref="items" class="flex flex-row flex-wrap justify-center text-center md:mx-24">
            @foreach ($library as $item)
            <template
            x-if="(filter.includes('{{ $item["type"] }}') || filter.length === 0) && (status_filter.includes('{{ $item["status"] }}') || status_filter.length === 0) && (favorite_only ? {{ $item["is_favorite"] }} : true)">
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
                        item.is_favorite = !item.is_favorite;
                        this.$wire.updateItem(item);
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
                            this.$wire.updateItem(this.item);
                        } else {
                            this.removeConfirmation.item = {};
                        }
                    },

                    nextSeason: function() {
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
                }' class="flex justify-center w-full p-5 my-10 lg:w-1/2 xl:w-1/3" :id="item.apiID">

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