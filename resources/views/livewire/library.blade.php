<div class="w-full h-full">

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

    <div class="w-full text-center">
        <input wire:model.debounce.300ms="search" placeholder="Search {{ $type }}s in library" type="search"
            class="w-1/3 input" />
    </div>
    @if ($library->count() > 0)
    {{-- Library Searchbar --}}
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
                }' class="flex justify-center w-full p-5 my-10 sm:w-1/2 lg:w-1/3" :id="item.apiID">

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
        You can search for a {{ $type }}, then click on a status and the {{ $type }} will appear here.
    </div>
    @endif
</div>