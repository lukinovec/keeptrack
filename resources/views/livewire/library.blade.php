<div class="h-full w-full md:mx-24" x-data="{ notes: false }">
    <div class="w-full my-10 font-bold flex flex-row justify-center items-center border-b-2 border-gray-400 py-5">
        <div class="flex-1">
            Title
        </div>
        <div class="flex-1">
            Type
        </div>
        <div class="flex-1">
            Progress
        </div>
        <div class="flex flex-1">
            Notes
        </div>
        <div class="flex-1">
            Rating
        </div>
    </div>
    @foreach ($library as $item)
    <div class="w-full my-10 flex flex-row justify-center items-center py-5">
        <div class="flex-1">
            {{ $item['name'] }} ({{ $item['year'] }})
        </div>
        <div class="flex-1">
            {{ ucfirst($item['type']) }}
        </div>
        <div class="flex-1">
            {{ $item['status'] }}
        </div>
        <div class="flex flex-1">
            <livewire:notes name="notes" id="notes" :item="$item" class="border border-black flex-1">
        </div>
        <div class="flex-1">
            <input type="text" class="w-8 border">/ 10
        </div>
    </div>
    @endforeach
</div>