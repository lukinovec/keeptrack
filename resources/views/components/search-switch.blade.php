<span>
    <br>
    <br>
    <span x-show="libraryType"
        class="p-2 w-full sm:w-24 ml-3 select-none cursor-pointer transition duration-200 ease-in-out border border-gray-400 hover:text-white hover:bg-gray-400 rounded-lg"
        x-on:click="$wire.switchSearch()"
        x-text="showSearch? 'Switch search mode to Library' : 'Switch search mode to Site'">
    </span>
</span>

{{-- <span x-show="libraryType">
    <br>
    <form class="mt-4 text-xl">
        <span class="mr-2">
            <input x-model="showSearch" type="radio" id="site" name="search" value="site">
            <label for="site">Site</label>
        </span>
        <span class="ml-2">
            <input x-model="showSearch" type="radio" id="library" name="search" value="library">
            <label for="library">Library</label>
        </span>
    </form>
</span> --}}