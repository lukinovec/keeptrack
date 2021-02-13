<div x-data="{ filter: '', status_filter: [], favorite_only: false }" class="w-full h-full">

    <div wire:loading wire:target='updateItem' class="loader" style="position: fixed; left: 50%; top: 8%"></div>

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
    <div class="flex flex-col items-center w-full text-center">
        <span class="p-1 m-2 text-lg font-bold text-center text-blueGray-300">Library filter</span>
        <input wire:model.debounce.300ms="search" placeholder="Search in library" type="search"
            class="w-full sm:w-2/3 input" />
        <div class="flex flex-wrap">
            <input x-model="filter" value="" type="radio" id="none" name="filter_type" />
            <label for="none">All types</option>
            @foreach ($library->unique("type") as $unique)
            <input x-model="filter" type="radio" id="{{ $unique["type"] }}" name="filter_type" value="{{ $unique["type"] }}">
            <label for="{{ $unique["type"] }}">{{ ucfirst($unique["type"]) }}</label>
            @endforeach

            <input x-model="favorite_only" type="checkbox" id="filter_favorite" name="filter_favorite" value="true">
            <label for="filter_favorite">Only favorites</label>

            @foreach ($library->unique("status") as $unique)
            <input x-model="status_filter" type="checkbox" id="{{ $unique["status"] }}" name="filter_status" value="{{ $unique["status"] }}">
            <label for="{{ $unique["status"] }}">{{ ucfirst($unique["status"]) }}</label>
            @endforeach
        </div>
    </div>

    @if ($library->count() > 0)
    <div x-ref="items" class="flex flex-row flex-wrap justify-center text-center md:mx-24">
        @foreach ($library as $item)
        <template
        x-if="('{{ $item["type"] }}' === filter || filter === '') && (status_filter.includes('{{ $item["status"] }}') || status_filter.length === 0) && (favorite_only ? {{ $item["is_favorite"] }} : true)">
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