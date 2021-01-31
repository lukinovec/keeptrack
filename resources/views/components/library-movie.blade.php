<div class="relative w-5/6 text-white item">
    <div class="w-full h-full bg-gray-700 bg-opacity-0 rounded-t-xxxl">
        <img :src="item.image" class="w-full transition-opacity duration-300 select-none rounded-t-xxxl"
            :class="{ 'opacity-25': edit.apiID == item.apiID }" alt="Image not found">

        {{-- Edit --}}
        <div class="absolute flex flex-col w-full h-full pb-32 text-left sm:pb-56 justify-evenly" x-show="edit.apiID == item.apiID"
            style="z-index: 999; top: 15%">
            <span class="flex-1 mx-3">
                Rating: <input class="w-6 edit" x-model.number="item.rating" type="text" name="rating">/10
            </span>
            <span class="flex-1 mx-3">
                Note: <input class="w-5/6 edit" x-model="item.note" type="text">
            </span>
            <br>
            <span class="flex-1 mx-3">
                Status: <select class="w-32 text-gray-700 edit" x-model="item.status" name="status">
                    <option class="text-gray-700" value="completed" x-text="statuses['completed']"></option>
                    <option class="text-gray-700" value="ptw" x-text="statuses['ptw']"></option>
                    <option class="text-gray-700" x-show="item.type != 'movie'" value="watching" x-text="statuses['watching']">
                    </option>
                </select>
            </span>
            <span class="flex-1">
                @if ($item['type'] != "movie")
                <div class="mx-3" x-show="item.apiID == edit.apiID" style="z-index: 999">
                    <div class="text-sm">
                        @if($item['type'] == 'series')
                        <label for="seasons">Season</label>
                        <select class="w-12 bg-black bg-opacity-25" x-model.number="item.season" id="seasons"
                            name="seasons">
                            <template x-for="season in item.seasons">
                                <option x-model="season.number" value="season.number" x-text="season.number"></option>
                            </template>
                        </select>
                        <br class="my-2">
                        @endif
                        <label for="episodes">Episode</label>
                        <input name="episodes" class="w-8 bg-black bg-opacity-25 border-b-2"
                            x-model.number="item.episode" type="text">
                        /
                        <span
                            x-text="item.seasons ? (item.seasons[item.season-1].episodes.Episodes).length : item.episodes"></span>

                        <button class="p-1 rounded-full bg-blueGray-700" x-on:click="item.episode++">+1</button>
                    </div>
                </div>
                @endif
            </span>
            <button
                class="w-1/4 py-1 mx-auto mt-2 text-base bg-gray-700 rounded-lg focus:outline-none hover:bg-gray-900"
                x-show="edit.apiID == item.apiID" x-on:click="$wire.emit('updateItem', item)">
                Submit
            </button>
        </div>
        {{-- Edit button --}}
        <x-edit-button />

        <div class="absolute bottom-auto w-full p-3 text-xl bg-gray-700 bg-opacity-50 title rounded-b-xxxl" x-text="item.name"></div>
    </div>
</div>