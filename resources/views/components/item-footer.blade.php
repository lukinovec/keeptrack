<div class="absolute bottom-auto flex justify-between w-full p-2 text-base bg-gray-700 bg-opacity-50 lg:text-xl title rounded-b-xxxl">

            {{-- Edit button --}}
            <div class="flex flex-col items-center justify-center text-xs" style="width: 30px">
                <p>Edit</p>
                <x-edit-button />
            </div>

            <span x-text="item.name" class="md:mx-2"></span>

            {{-- Favorite button --}}
            <div class="flex flex-col items-center justify-center text-xs" style="width: 30px">
                <p>Favorite</p>
                <x-favorite-button />
            </div>

        </div>