<div>
    <div class="text-center">
        <div class="w-full">
            <input wire:model.debounce.300ms="search" type="text" placeholder="Search something"
                class="p-4 text-2xl border-b-2 w-1/3" />
            <select wire:model="searchtype" name="searchtype" id="searchtype">
                <option value="movie">TV / Movie</option>
                <option value="book">Book</option>
            </select>
        </div>
    </div>
    <div>
        @if ($isSearch === false)
        <livewire:menu />
        @else
        <div>
            <div wire:loading>
                Processing Request...
            </div>
            @foreach ($results as $item)
            {{ $item["Title"] }}
            @endforeach
        </div>
        @endif
    </div>
</div>