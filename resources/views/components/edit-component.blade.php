<div class="absolute w-full h-full pb-32 sm:pb-56 flex flex-col text-left" x-show="edit.apiID == item.apiID"
    style="z-index: 999; top: 25%">
    <br>
    <span class="flex-1 mx-3">
        Rating: <input class="w-6 edit" x-model.number="item.rating" type="text" name="rating">/10
    </span>
    <span class="flex-1 mx-3">
        Note: <input class="edit w-5/6" x-model="item.note" type="text">
    </span>
    <br>
    <x-status-component />
    @if ($item["type"] == "book")
    <x-edit-book :item="$item" />
    @else
    <x-edit-movie :item="$item" />
    @endif
    {{-- Submit button --}}
    <button class="w-1/4 rounded-lg focus:outline-none text-base py-1 mt-2 mx-auto bg-gray-700 hover:bg-gray-900"
        x-show="edit.apiID == item.apiID" x-on:click="submit(item)">
        Submit
    </button>
</div>