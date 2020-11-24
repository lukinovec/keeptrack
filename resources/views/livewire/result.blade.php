<div x-show="infoid === '{{$item['id']}}' || infoid === ''"
    class="text-white mx-10 my-4 p-5 w-5/6 md:w-1/5 rounded-xxxl item shadow-xl border-t-2 border-blueGray-300"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90">
    <span class="text-2xl font-bold">
        {{ $item["title"] }}
    </span>

    {{ $item["year"] }}
    <div id="'{{ $item['id'] }}'" class="flex justify-center align-center">
        <img class="my-2 rounded-xxxl" src="{{ $item['image'] }}" alt="image">
    </div>
    <div class="info flex font-bold">
        <div class="flex-1 btn text-center" x-on:click="infoid ? infoid = '' : infoid = '{{ $item['id'] }}'">
            Toggle details
        </div>
        <select x-data='{ statuses: @json($statuses) }' class="text-center h-16 overflow-hidden flex-1"
            wire:model="item.status">
            <option value="none" x-text="statuses.none"></option>
            <option value="completed" x-text="statuses.completed"></option>
            <option value="ptw" x-text="statuses.ptw"></option>
            @if ($item["type"] !== "movie")
            <option value="watching" x-text="statuses.watching"></option>
            @endif
        </select>
    </div>
</div>