<div class="w-full">
    <input wire:model.debounce.200ms="search" type="text" placeholder="Search something"
        class="p-4 text-2xl border-b-2 w-1/3" />
    <select wire:model="searchType" name="searchtype" id="searchtype">
        <option value="movie">TV / Movie</option>
        <option value="book">Book</option>
    </select>
</div>