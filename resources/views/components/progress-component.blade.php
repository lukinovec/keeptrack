<span class="flex-1">
    <div class="mx-3" x-show="item.apiID == edit.apiID" style="z-index: 999">
        <div class="flex items-center space-x-2 text-base">
        <template x-if="item.type == 'series'">
            <span class="flex-1">
                <label for="seasons">Season</label>
                <select class="w-12 bg-black bg-opacity-25" x-model.number="item.season" id="seasons"
                name="seasons">
                <template x-for="season in item.seasons">
                    <option x-model="season.number" value="season.number" x-text="season.number"></option>
                </template>
            </select>
            <br class="my-2">
            <span class="flex items-center">
                <label class="pr-1" for="episodes">Episode</label>
                <input id="episodes" name="episodes" class="w-8 bg-black bg-opacity-25 border-b-2"
                x-model.number="item.episode" type="text">
                /
                <span
                x-text="item.seasons ? (item.seasons[item.season-1].episodes.Episodes).length : item.episodes"></span>
                <button class="flex items-center justify-center rounded-full bg-blueGray-700" style="width: 36px; height: 36px; padding: 10px" x-on:click="item.episode++">+1</button>
            </span>
            </span>
        </template>
        <template x-if="item.type == 'book'">
            <span class="flex-1">
                <div class="mx-3" x-show="item.apiID == edit.apiID" style="z-index: 999">
                    <div class="flex items-center space-x-2 text-base">
                        <label for="pages_read">Pages Read</label>
                        <input id="pages_read" name="pages_read" class="w-12 p-1 bg-black bg-opacity-25 border-b-2"
                        x-model.number="item.pages_read" type="text">
                        <button class="flex items-center justify-center rounded-full bg-blueGray-700" style="width: 36px; height: 36px; padding: 10px" x-on:click="item.pages_read++">+1</button>
                    </div>
                </div>
            </span>
        </template>
        </div>
    </div>
</span>