<div x-data="{ filter: false }" class="w-full h-full">

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
    <div x-on:click="filter = !filter" class="w-full p-1 m-2 text-lg font-bold text-center underline cursor-pointer select-none text-blueGray-300">Filter library</div>
    <div x-show="filter">
        <div class="w-full text-center">
            <input wire:model.debounce.300ms="search" placeholder="Search {{ $type }}s in library" type="search"
                class="w-1/3 input" />
        </div>
    </div>


    @if ($library->count() > 0)
    <div class="flex flex-row flex-wrap justify-center text-center md:mx-24">
        @foreach ($library as $item)
        <div x-data='{
                    item: @json($item),
                    statuses: @json($statuses),
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
                        $wire.favoriteItem(item);
                    },

                    submit: function(item) {
                        $wire.updateItem(item);
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
                            $wire.updateItem(this.item);
                        } else {
                            this.removeConfirmation.item = {};
                        }
                    }
                }' class="flex justify-center w-full p-5 my-10 lg:w-1/2 xl:w-1/3" :id="item.apiID">

            @if ($type === "book")
            <x-library-book class="" :item="$item" />
            @else
            <x-library-movie :item="$item" />
            @endif
        </div>
        @endforeach
    </div>
    @else
    <div wire:loading.remove class="w-full mt-40 text-2xl text-center">
        <span class="font-bold">
            No items in your library
        </span><br>
        <p>
            You can <a href="/home" class="underline">search</a> for a {{ $type }}, then click on a status and the {{ $type }} will appear here.
        </p>
    </div>
    @endif
</div>