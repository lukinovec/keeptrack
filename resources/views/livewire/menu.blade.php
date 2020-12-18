<div class="flex flex-col sm:flex-row w-full justify-evenly items-center mt-24" style="height: 59%">
    <div class="flex flex-1 flex-col justify-center items-center">
        <div class="flex-1 p-10 text-center">
            <a href="/library/movie">
                <div x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90" class="flex-1 text-center">
                    <span class="text-blueGray-300 p-2">Your movies & TV</span>
                    <svg fill="rgba(203, 213, 225)"
                        class="icon-film m-auto rounded-full h-24 w-24 transform duration-150 p-2 hover:scale-110 bg-transparent border-4 border-blueGray-300"
                        viewBox="-31 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                        <g fill-rule="evenodd">
                            <path
                                d="m440.589844 206.675781h-341.171875l327.699219-94.929687c2.546874-.738282 4.695312-2.460938 5.976562-4.78125 1.28125-2.324219 1.585938-5.058594.847656-7.605469l-17.148437-59.199219c-6.851563-23.644531-28.867188-40.160156-53.539063-40.160156-5.199218 0-10.378906.738281-15.402344 2.191406l-307.675781 89.128906c-14.230469 4.121094-26.023437 13.582032-33.214843 26.632813-7.1875 13.050781-8.875 28.078125-4.753907 42.304687l16.753907 57.835938v238.253906c0 30.6875 24.964843 55.652344 55.648437 55.652344h120.164063c5.523437 0 10-4.476562 10-10s-4.476563-10-10-10h-120.160157c-19.660156 0-35.652343-15.992188-35.652343-35.652344v-136.085937h51.230468.023438.019531 78.3125.023437.023438 78.3125.023438.023437 78.3125.023437.019532 105.28125v136.085937c0 19.660156-15.992188 35.652344-35.652344 35.652344h-120.164062c-5.519532 0-10 4.476562-10 10s4.480468 10 10 10h120.164062c30.6875 0 55.652344-24.964844 55.652344-55.652344v-239.671875c0-5.523437-4.476563-10-10-10zm-176.332032 93.585938 42.488282-73.585938h55.261718l-42.484374 73.585938zm-78.359374 0 42.488281-73.585938h55.261719l-42.484376 73.585938zm-78.355469 0 42.484375-73.585938h55.265625l-42.488281 73.585938zm37.179687-129.457031-71.148437-68.335938 53.308593-15.441406c.375.546875.8125 1.0625 1.3125 1.542968l71.148438 68.335938-53.308594 15.441406c-.375-.546875-.816406-1.066406-1.3125-1.542968zm134-125.839844 71.148438 68.335937-53.308594 15.441407c-.375-.546876-.8125-1.066407-1.3125-1.542969l-71.148438-68.335938 53.308594-15.441406c.375.546875.8125 1.0625 1.3125 1.542969zm-75.265625 21.804687 71.148438 68.332031-53.308594 15.445313c-.375-.546875-.8125-1.066406-1.3125-1.542969l-71.148437-68.335937 53.308593-15.441407c.378907.542969.816407 1.0625 1.3125 1.542969zm149.960938-45.367187c3.210937-.929688 6.519531-1.402344 9.835937-1.402344 15.824219 0 29.9375 10.578125 34.328125 25.726562l14.367188 49.589844-40.121094 11.621094c-.378906-.546875-.816406-1.0625-1.316406-1.542969l-71.144531-68.332031zm-328.9375 106.199218c4.609375-8.371093 12.160156-14.433593 21.261719-17.070312l5.875-1.703125c.378906.546875.816406 1.066406 1.3125 1.542969l71.148437 68.335937-88.292969 25.578125-14.367187-49.589844c-2.636719-9.097656-1.546875-18.71875 3.0625-27.09375zm14.480469 99.074219h87.972656l-42.484375 73.585938h-45.488281zm303.65625 73.585938 42.484374-73.585938h45.488282v73.585938zm0 0" />
                            <path
                                d="m303.921875 405.113281c0-3.574219-1.90625-6.875-5-8.660156l-87.855469-50.722656c-3.09375-1.785157-6.90625-1.785157-10 0-3.09375 1.785156-5 5.085937-5 8.660156v101.445313c0 3.570312 1.90625 6.871093 5 8.65625 1.546875.894531 3.273438 1.34375 5 1.34375 1.726563 0 3.453125-.449219 5-1.34375l87.855469-50.71875c3.09375-1.785157 5-5.085938 5-8.660157zm-87.855469 33.402344v-66.804687l57.855469 33.402343zm0 0" />
                            <path
                                d="m234.773438 492c-5.507813 0-10 4.492188-10 10s4.492187 10 10 10c5.511718 0 10-4.492188 10-10s-4.488282-10-10-10zm0 0" />
                        </g>
                    </svg>
                </div>
            </a>
        </div>
        <h1 class="text-white font-bold">Recently updated</h1>
        <div x-data='{ item: @json($latestMovie) }' class="flex-1 w-64 m-2 wrapper p-3 text-center">
            <h1 class="text-white font-bold" x-text="item.name"></h1>
            @if($latestMovie['type'] == 'series')
            <label for="seasons">Season</label>
            <select class="w-12 bg-black bg-opacity-25" x-model.number="item.season" id="seasons" name="seasons">
                <template x-for="season in item.seasons">
                    <option x-model="season.number" value="season.number" x-text="season.number"></option>
                </template>
            </select>
            <br class="my-2">
            @endif
            <label for="episodes">Episode</label>
            <input name="episodes" class="w-8 border-b-2 bg-black bg-opacity-25" x-model.number="item.episode"
                type="text">
            /
            <span x-text="item.seasons ? (item.seasons[item.season-1].episodes.Episodes).length : item.episodes"></span>

            <button x-on:click="item.episode++">+</button>
            <br>
            <button class="btn p-1 mt-3" x-on:click="$wire.submitChanges(item)">Update</button>
        </div>
    </div>

    <div class="flex flex-1 flex-col justify-center items-center">
        <a href="/library/book">
            <div x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90" class="flex-1 text-center p-10">
                <span class="text-blueGray-300 p-2">Your books</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="rgba(203, 213, 225)"
                    class="icon-book-open m-auto rounded-full h-24 w-24 transform duration-150 p-2 hover:scale-110 bg-transparent border-4 border-blueGray-300">
                    <g>
                        <path class="secondary"
                            d="M12 21a2 2 0 0 1-1.41-.59l-.83-.82A2 2 0 0 0 8.34 19H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4a5 5 0 0 1 4 2v16z" />
                        <path class="primary"
                            d="M12 21V5a5 5 0 0 1 4-2h4a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1h-4.34a2 2 0 0 0-1.42.59l-.83.82A2 2 0 0 1 12 21z" />
                    </g>
                </svg>
            </div>
        </a>
        <h1 class="text-white font-bold">Recently updated</h1>
        <div x-data='{ item: @json($latestBook) }' class="flex-1 m-2 wrapper w-64 p-3 text-center">
            <h1 class="text-white font-bold" x-text="item.name"></h1>
            <label for="pages_read">Pages Read</label>
            <input name="pages_read" class="w-8 border-b-2 bg-black bg-opacity-25" x-model.number="item.pages_read"
                type="text">
            <button x-on:click="item.pages_read++">+</button>
            <br>
            <button class="btn p-1 mt-3" x-on:click="$wire.submitChanges(item)">Update</button>
        </div>
    </div>
</div>