<div x-data="{ infoid: @entangle('infoid') }">
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
    <div>
        @if ($isSearch === false)
        <livewire:menu />
        @else
        <div class="mt-4 flex flex-wrap" :class="{ 'items-center justify-center' : infoid === '' }">
            <span class="font-bold" x-text="infoid"></span> <br>

            @if ($results)
            @foreach ($results as $item)
            <div x-show="infoid === '{{$item['id']}}' || infoid === ''"
                class="mx-10 my-4 p-5 w-1/4 item shadow-xl border-t-2 border-red-700"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90">
                <span class="text-2xl font-bold">
                    {{ $item["title"] }}
                </span>
                {{ $item["year"] }}
                <div class="flex">
                    <img class="my-2" src="{{ $item["image"] }}" alt="image">
                    <div class="btns flex flex-col w-full text-center">
                        <a class="flex-1 flex justify-center items-center font-bold m-2 hover:bg-red-100">Completed</a>
                        <a class="flex-1 flex justify-center items-center font-bold m-2 hover:bg-red-100" href="">Plan
                            To Watch</a>
                        @if ($item["type"] === "series")
                        <a class="flex-1 flex justify-center items-center font-bold m-2 hover:bg-red-100"
                            href="">Watching</a>
                        @endif
                    </div>
                </div>
                <div class="info flex font-bold">
                    <div class="flex-1 text-center p-5 text-white font-bold bg-red-700" id="{{ $item['id'] }}"
                        x-on:click="infoid ? infoid = '' : infoid = '{{ $item['id'] }}'"
                        x-text="infoid ? 'Back to all results' : 'More information'">
                    </div>
                </div>
            </div>
            @endforeach
            @else
            No results found
            @endif
            @if ($details)
            <div x-show="infoid" class="flex-1">
                <div>
                    <span class="font-bold"> {{ $details["Genre"] }} </span> <br>
                    {{ $details["Plot"] }}
                </div>
            </div>
            @endif

        </div>
        @endif
    </div>
</div>