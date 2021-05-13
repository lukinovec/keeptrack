<div class="absolute bottom-auto flex justify-between w-full p-2 text-base bg-gray-800 bg-opacity-50 shadow-xl lg:text-lg title rounded-b-xxxl">
            @if ($editable)
            {{-- Edit button --}}
            <div class="flex flex-col items-center justify-center text-xs" style="width: 30px">
                <p>Edit</p>
                <x-edit-button />
            </div>
            @endif

            <span x-text="item.name" class="w-full text-center md:mx-2"></span>

            @if ($editable)
            {{-- Favorite button --}}
            <div class="flex flex-col items-center justify-center text-xs" style="width: 30px">
                <p>Favorite</p>
                <x-favorite-button />
            </div>
            @endif
</div>