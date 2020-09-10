<div>
    <input wire:model="search" type="text" placeholder="Search something" />
    <select wire:model="searchType" name="searchtype" id="searchtype">
        <option value="movie">TV / Movie</option>
        <option value="book">Book</option>
    </select>
    <button wire:click="submitSearch">Submit</button>
    <div class="">
        You're searching a {{ $searchType }} named {{ $search }}
    </div>
</div>