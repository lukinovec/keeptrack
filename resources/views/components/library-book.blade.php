<div class="relative w-5/6 text-white item">
    <div class="w-full bg-gray-700 rounded-t-xxxl">
        <img :src="item.image" class="w-full transition-opacity duration-300 select-none rounded-t-xxxl"
            :class="{ 'opacity-25': edit.apiID == item.apiID }" alt="Image not found">

        {{-- Edit --}}
        <x-edit-component>



            <span class="flex-1 mx-3">
                <label class="m-1 text-base" for="status">Status</label>
                <select id="status" class="w-40 p-1 bg-transparent border-4 text-blueGray-300 border-blueGray-300 rounded-xxl" x-model="item.status" name="status">
                    <option class="text-gray-700" value="completed" x-text="statuses['completed']"></option>
                    <option class="text-gray-700" value="ptw" x-text="statuses['ptw']"></option>
                    <option class="text-gray-700" value="watching" x-text="statuses['watching']">
                    </option>
                </select>
            </span>

            <span class="flex-1">
                <div class="mx-3" x-show="item.apiID == edit.apiID" style="z-index: 999">
                    <div class="flex items-center space-x-2 text-base">
                        <label for="pages_read">Pages Read</label>
                        <input id="pages_read" name="pages_read" class="w-12 p-1 bg-black bg-opacity-25 border-b-2"
                        x-model.number="item.pages_read" type="text">
                        <button class="flex items-center justify-center rounded-full bg-blueGray-700" style="width: 36px; height: 36px; padding: 10px" x-on:click="item.pages_read++">+1</button>
                    </div>
                </div>
            </span>
        </x-edit-component>

        {{-- Remove button --}}
        <x-remove-button />

        <x-item-footer />
        </div>
</div>