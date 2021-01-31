<div class="relative w-5/6 text-white item">
    <div class="w-full bg-gray-700 rounded-t-xxxl">
        <img :src="item.image" class="w-full transition-opacity duration-300 select-none rounded-t-xxxl"
            :class="{ 'opacity-25': edit.apiID == item.apiID }" alt="Image not found">

        {{-- Edit --}}
        <x-edit-component>
            <span class="flex-1 mx-3">
                <label class="m-1 text-base" for="status">Status</label>
                <select id="status"class="w-32 edit" x-model="item.status" name="status">
                    <option value="completed" x-text="statuses['completed']"></option>
                    <option value="ptw" x-text="statuses['ptw']"></option>
                    <option value="watching" x-text="statuses['watching']">
                    </option>
                </select>
            </span>
            <span class="flex-1">
                <div class="mx-3" x-show="item.apiID == edit.apiID" style="z-index: 999">
                    <div class="text-sm">
                        <label for="pages_read">Pages Read</label>
                        <input  id="pages_read" name="pages_read" class="w-8 bg-black bg-opacity-25 border-b-2"
                        x-model.number="item.pages_read" type="text">
                        <button x-on:click="item.pages_read++">+</button>
                    </div>
                </div>
            </span>
        </x-edit-component>
        {{-- Edit button --}}
        <x-edit-button />

        {{-- Favorite button --}}
        <x-favorite-button />

        <div class="absolute bottom-auto w-full p-3 text-xl bg-gray-700 bg-opacity-50 rounded-b-xxxl title" x-text="item.name"></div>
    </div>
</div>