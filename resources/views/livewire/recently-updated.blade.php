<div x-data="{ filter: '' }" class="text-center">
    <select name="filter" x-model="filter" id="filter">
        <option value="" selected>No filter</option>
        @foreach ($current->unique("type") as $type)
        <option value="{{ $type["type"] }}">{{ ucfirst($type["type"]) }}</option>
        @endforeach
    </select>

    <section class="flex flex-wrap">
        @foreach ($current as $item)
        <div x-show="filter === '{{$item["type"]}}' || filter === ''" class="flex flex-col text-white">
            <img src="{{ $item["image"] }}" alt="">
            {{ $item["name"] }}
        </div>
        @endforeach

    </section>
</div>