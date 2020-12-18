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
                    submit: function(item) {
                        $wire.updateItem(item);
                        this.edit = false;
                    },
                }' class="my-10 flex justify-center p-5 w-full sm:w-1/2 lg:w-1/3" :id="item.apiID">
            @if ($type === "book")
            <x-library-book :item="$item" />
            @else
            <x-library-movie :item="$item" />
            @endif
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