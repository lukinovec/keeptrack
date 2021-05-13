<div class="relative w-2/3 text-white item">
    <div class="w-full bg-gray-800 rounded-t-xxxl">
        <img :src="item.image" class="w-full transition-opacity duration-300 select-none rounded-t-xxxl"
            :class="{ 'opacity-10': edit.apiID == item.apiID }"  style="max-height: 50vh;" alt="Image not found">
        {{-- Edit --}}
        <x-edit-component />

        @if ($editable)
        {{-- Remove button --}}
        <x-remove-button />
        @endif

        <x-item-footer :editable='$editable' />

    </div>
</div>
