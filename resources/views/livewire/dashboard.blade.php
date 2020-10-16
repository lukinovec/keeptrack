<div class="h-full w-full" x-data="{ infoid: @entangle('infoid'), isSearch: @entangle('isSearch') }">
    <div class="text-center">
        <div class="w-full">
            <input wire:model.debounce.300ms="search" x-on:focus="infoid = ''" type="text"
                placeholder="Search something" class="p-4 text-2xl border-b-2 w-1/3" />
            <select wire:model="searchtype" name="searchtype" id="searchtype">
                <option value="movie">TV / Movie</option>
                <option value="book">Book</option>
            </select>
        </div>
    </div>
    <div class="h-full w-full">
        <div x-show="!isSearch" class="h-full w-full" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100">
            <livewire:menu class="h-full w-full" id="menu" :authUserID="$authUser" />
        </div>
        <div x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100" x-show="isSearch" class="mt-4 flex flex-wrap"
            :class="{ 'items-center justify-center' : infoid === '' }">
            @if ($results)
            @foreach ($results as $item)
            @livewire("result", ["item" => $item], key($item["id"]))
            @endforeach
            @else
            No results found
            @endif
            @if ($details)
            <br>
            <div x-show="infoid" class="flex-1">
                <div>
                    <br><br>
                    <span class="font-bold"> {{ $details["Genre"] }} </span> <br>
                    <span class="font-bold"> {{ $details["Plot"] }} </span> <br>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>