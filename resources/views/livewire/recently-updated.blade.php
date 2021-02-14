<div x-data="{ filter: '' }" class="flex flex-col h-full space-y-10 text-center">
    <div class="flex">
        <input x-model="filter" value="" type="radio" id="none" name="filter_options" />
        <label for="none">No filter</option>
            @foreach ($current->unique("type") as $type)
            <input x-model="filter" type="radio" id="{{ $type["type"] }}" name="filter_options" value="{{ $type["type"] }}">
            <label for="{{ $type["type"] }}">{{ ucfirst($type["type"]) }}</label>
            @endforeach
    </div>

    <section class="flex flex-wrap flex-1">
        @foreach ($current as $item)
        <div x-show="filter === '{{$item["type"]}}' || filter === ''" class="flex flex-col text-white">
            <img src="{{ $item["image"] }}" alt="">
            {{ $item["name"] }}
        </div>
        @endforeach

    </section>
</div>