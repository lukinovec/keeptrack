<div class="item relative text-white w-5/6">
    <div class="w-full bg-gray-700">
        <img :src="item.image" class="w-full select-none transition-opacity duration-300"
            :class="{ 'opacity-25': edit.apiID == item.apiID }" alt="Image not found">

        {{-- Edit --}}
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
            <span class="flex-1 mx-3">
                Status: <select class="edit w-32" x-model="item.status" name="status">
                    <option value="completed" x-text="statuses['completed']"></option>
                    <option value="ptw" x-text="statuses['ptw']"></option>
                    <option value="watching" x-text="statuses['watching']">
                    </option>
                </select>
            </span>
            <span class="flex-1">
                <div class="mx-3" x-show="item.apiID == edit.apiID" style="z-index: 999">
                    <div class="text-sm">
                        <label for="pages_read">Pages Read</label>
                        <input name="pages_read" class="w-8 border-b-2 bg-black bg-opacity-25"
                            x-model.number="item.pages_read" type="text">
                        <button x-on:click="item.pages_read++">+</button>
                    </div>
                </div>
            </span>
            <button
                class="w-1/4 rounded-lg focus:outline-none text-base py-1 mt-2 mx-auto bg-gray-700 hover:bg-gray-900"
                x-show="edit.apiID == item.apiID" x-on:click="$wire.emit('updateItem', item)">
                Submit
            </button>
        </div>
        {{-- Edit button --}}
        <x-edit-button />

        <div class="title absolute text-xl w-full bottom-auto bg-gray-700 p-3" x-text="item.name"></div>
    </div>
</div>