            <div class="flex flex-col items-center justify-center w-11/12 text-center">
                {{-- <h1 class="font-bold text-white">Recently updated</h1> --}}
                <div class="flex flex-col items-center justify-center">
                    <div class="relative mx-auto" x-data="{ activeSlide: 1, slides: [1, 2] }">
                        <!-- Prev/Next Arrows -->
                        <div class="absolute inset-0 z-0 flex">
                            <div class="flex items-center justify-start w-1/2">
                                <button
                                    class="w-12 h-12 ml-10 font-bold rounded-full bg-blueGray-300 text-blueGray-900 hover:text-warmGray-800 hover:shadow-lg"
                                    x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                                    &#8592;
                                </button>
                            </div>
                            <div class="flex items-center justify-end w-1/2">
                                <button
                                    class="w-12 h-12 mr-10 font-bold rounded-full bg-blueGray-300 text-blueGray-900 hover:text-warmGray-800 hover:shadow"
                                    x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                                    &#8594;
                                </button>
                            </div>
                        </div>

                        <!-- Slides -->
                        <template class="z-10" x-for="slide in slides" :key="slide">
                            <div x-show="activeSlide === slide" class="flex items-center h-64 p-24 bg-transparent">
                                <div x-show="activeSlide === 1">
                                    @if ($latestMovie)
                                    <div x-data='{ item: @json($latestMovie) }'
                                        class="relative flex-1 w-64 h-48 p-3 m-2 text-center wrapper">
                                        <h1 class="font-bold text-white" x-text="item.name"></h1>
                                        @if($latestMovie['type'] == 'series')
                                        <label for="seasons">Season</label>
                                        <select class="w-12 bg-black bg-opacity-25" x-model.number="item.season"
                                            id="seasons" name="seasons">
                                            <template x-for="season in item.seasons">
                                                <option x-model="season.number" value="season.number"
                                                    x-text="season.number">
                                                </option>
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

                                        <button x-on:click="item.episode++">+</button>
                                        <br>
                                        <button class="absolute bottom-0 left-0 right-0 p-1 mx-auto btn"
                                            x-on:click="$wire.submitChanges(item)">Update</button>
                                    </div>
                                    @else
                                    <div class="flex-1 w-64 p-3 m-2 text-center wrapper">
                                        <h1 class="font-bold text-white">No TV shows in your list.</h1>
                                    </div>
                                    @endif
                                </div>
                                <div x-show="activeSlide === 2">
                                    @if ($latestBook)
                                    <div x-data='{ item: @json($latestBook) }'
                                        class="relative flex-1 w-64 h-48 p-3 m-2 text-center wrapper">
                                        <h1 class="font-bold text-white" x-text="item.name"></h1>
                                        <label for="pages_read">Pages Read</label>
                                        <input name="pages_read" class="w-8 bg-black bg-opacity-25 border-b-2"
                                            x-model.number="item.pages_read" type="text">
                                        <button x-on:click="item.pages_read++">+</button>
                                        <button class="absolute bottom-0 left-0 right-0 p-1 mx-auto btn"
                                            x-on:click="$wire.submitChanges(item)">Update</button>
                                    </div>
                                    @else
                                    <div class="flex-1 w-64 p-3 m-2 text-center wrapper">
                                        <h1 class="font-bold text-white">No books in your list.</h1>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </template>
                        <!-- Buttons -->
                        <div class="relative z-30 flex items-center justify-center w-full px-2">
                            <template x-for="slide in slides" :key="slide">
                                <button x-text="slide == 1 ? 'Recent TV show' : 'Recent book'"
                                    class="flex-1 w-4 mx-2 mt-4 mb-0 overflow-hidden transition-colors duration-200 ease-out rounded-full hover:bg-blueGray-400 hover:shadow-lg"
                                    :class="{
                    'bg-blueGray-300 text-blueGray-800': activeSlide === slide,
                    'bg-warmGray-900 text-blueGray-300': activeSlide !== slide
                }" x-on:click="activeSlide = slide">
                                </button>
                            </template>
                        </div>
            </div>
        </div>
    </div>