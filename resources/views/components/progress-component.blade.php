<span class="flex-1">
    <div class="mx-3" x-show="item.apiID == edit.apiID" style="z-index: 999">
        <section class="flex items-center space-x-2 text-base">

        <template x-if="item.type == 'series'">
            <span class="flex-1">
                <label for="seasons">Season</label>
                <select class="w-12 bg-black bg-opacity-25" x-model.number="item.user_progress.season" id="seasons"
                name="seasons">
                    <template x-for="season in item.progress.seasons">
                        <option class="text-gray-700 bg-white" x-model="season.number" value="season.number" x-text="season.number"></option>
                    </template>
                </select>
                <br class="my-2">
                <span class="flex items-center space-x-1">
                    <label class="pr-1" for="episodes">Episode</label>
                    <input x-on:change="nextSeason()" id="episodes" name="episodes" class="w-12 bg-black bg-opacity-25 border-b-2"
                    x-model.number="item.user_progress.episode" type="number">
                    <span x-show="item.progress.seasons[item.user_progress.season - 1].episodes.Episodes.Title !== 'Season request failed'">
                        /
                    </span>
                    <span
                    x-text="item.progress.seasons ? (item.progress.seasons[item.user_progress.season-1].episodes.Episodes).length : item.user_progress.episodes">
                    </span>
                </span>
            </span>
        </template>

        <template x-if="item.type == 'book'">
            <span class="flex-1">
                <div x-show="item.apiID == edit.apiID" style="z-index: 999">
                    <div class="flex items-center space-x-2 text-base">
                        <label for="pages_read">Pages Read</label>
                        <input id="pages_read" name="pages_read" class="w-16 p-1 bg-black bg-opacity-25 border-b-2"
                        x-model.number="item.user_progress.pages_read" type="number">
                    </div>
                </div>
            </span>
        </template>

        <template x-if="item.searchtype == 'anime'">
            <span class="flex-1">
                <span class="flex items-center space-x-1">
                    <label class="pr-1" for="episodes">Episode</label>
                    <input id="episodes" name="episodes" class="w-12 bg-black bg-opacity-25 border-b-2"
                    x-model.number="item.user_progress.episode" type="number">
                    /
                    <span
                    x-text="item.progress.episodes">
                    </span>
                </span>
            </span>
        </template>
        </section>
    </div>
</span>