<span x-show="libraryType"
    class="p-2 w-24 ml-3 select-none cursor-pointer transition duration-200 ease-in-out border border-gray-400 hover:bg-gray-400 hover:text-white rounded-lg"
    x-on:click="$wire.switchSearch()" x-text="showSearch? 'Search your library' : 'Search the site'">
</span>