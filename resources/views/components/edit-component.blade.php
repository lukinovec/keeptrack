<div class="absolute flex flex-col w-full h-full pb-32 text-left sm:pb-56" x-show="edit.apiID == item.apiID"
            style="z-index: 999; top: 25%">
            <x-rating-component />
            <x-note-component />
            {{ $slot }}
            <x-submit-button />
</div>