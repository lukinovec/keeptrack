<div class="relative w-5/6 text-white item">
    <div class="w-full bg-gray-700 rounded-t-xxxl">
        <img :src="item.image" class="w-full transition-opacity duration-300 select-none rounded-t-xxxl"
            :class="{ 'opacity-25': edit.apiID == item.apiID }"  style="max-height: 55vh;" alt="Image not found">
        {{-- Edit --}}
        <x-edit-component />

        {{-- Remove button --}}
        <x-remove-button />

        <x-item-footer />
        </div>
</div>