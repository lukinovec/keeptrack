 <a class="flex items-center justify-center flex-1 m-2 font-bold hover:bg-red-100"
    :class="{ 'border-l-4 border-red-700': '{{ $item["status"] }}' === '{{ $statuses[$status] }}' }"
    wire:click="$emitUp('changeStatus', '{{ json_encode($item) }}', '{{ $statuses[$status] }}')"
    x-text="'{{ $statuses[$status] }}'">
</a>