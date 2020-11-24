<img :src="item.image" class="w-full rounded-xxxl select-none transition-opacity duration-300"
    :class="{ 'opacity-25': edit.apiID == item.apiID }" alt="Image not found">
<div class="title absolute text-xl w-full top-0 rounded-t-xxxl bg-gradient-to-b from-blueGray-700 to-transparent p-2"
    x-text="item.name">
</div>
{{-- Edit --}}
<div class="absolute w-full h-full pb-32 sm:pb-64 flex flex-col text-left" x-show="edit.apiID == item.apiID"
    style="z-index: 999; top: 25%">
    <br>
    <span class="flex flex-1 mx-3">
        <span class="flex-1">
            <span class="text-sm">
                Rating
            </span> <br>
            <input maxlength="2" class="w-12 input text-lg" x-model.number="item.rating" type="text" name="rating"> /
            10
        </span>
        <span class="flex-1 mx-3">
            <x-status-component><span class="text-sm">
                    Status</span><br> </x-status-component>
        </span>
    </span>
    <span class="flex-1 mx-3">
        <span class="text-sm">Note</span> <br>
        <input class="input w-5/6" x-model="item.note" type="text">
    </span>
    <br>