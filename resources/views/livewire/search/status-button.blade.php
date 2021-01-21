<a class="flex-1 flex justify-center items-center font-bold m-2 hover:bg-red-100"
    :class="{ 'border-l-4 border-red-700': '{{ $item["status"] }}' === '{{ $statuses[$status] }}' }"
    wire:click="$emitUp('changeStatus', '{{ json_encode($item) }}', '{{ $statuses[$status] }}')"
    x-text="'{{ $statuses[$status] }}'">
</a>