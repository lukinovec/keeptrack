<div x-show="infoid === '{{$item['id']}}' || infoid === ''"
    class="mx-10 my-4 p-5 w-full sm:w-1/4 item shadow-xl border-t-2 border-red-700"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90">
    <span class="text-2xl font-bold">
        {{ $item["title"] }}
    </span>

    {{ $item["year"] }}

    <div id="{{ $item['id'] }}" class="flex">
        <img class="my-2" src="{{ $item['image'] }}" alt="image">
        <div class="btns flex flex-col w-full text-center">
            @livewire("status-button", ["item" => $item, "status" => "completed"], key(rand()))
            @livewire("status-button", ["item" => $item, "status" => "ptw"], key(rand()+1))
            @if ($item["type"] === "series")
            @livewire("status-button", ["item" => $item, "status" => "watching"], key(rand()+2))
            @endif
        </div>
    </div>
    <div class="info flex font-bold">
        <div class="flex-1 text-center p-5 text-white font-bold bg-red-700"
            x-on:click="infoid ? infoid = '' : infoid = '{{ $item['id'] }}'">
            Toggle details
        </div>

        @if ($item["status"])
        <div wire:click="$emit('goToLibrary', '{{ $item['type'] }}')"
            class="flex-1 text-center p-5 text-white font-bold bg-red-800">
            Go to Library
        </div>
        @endif
    </div>
</div>