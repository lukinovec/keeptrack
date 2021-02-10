<div x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90" class="flex flex-col space-y-2 text-center">

    <div class="{{ $classes }}">
        <img class="{{ $svg_classes }}" src="{{ asset($status["image"]) }}" alt="library link">
        Your {{ $status["type"] }}s
    </div>
</div>
