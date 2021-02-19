<div class="absolute z-10 flex flex-col justify-center w-full h-full pb-32 text-left sm:pb-56" x-show="edit.apiID == item.apiID || removeConfirmation.item.apiID == item.apiID"
            style="top: 3rem">
            <span x-show="edit" class="p-1 m-2 mx-auto text-lg font-bold underline cursor-pointer text-blueGray-300" x-on:click="edit = false">Close edit</span>
            <div class="flex flex-col space-y-5" x-show="Object.keys(removeConfirmation.item).length === 0">
                <x-rating-component x-show="Object.keys(removeConfirmation.item).length === 0" />
                <x-note-component x-show="Object.keys(removeConfirmation.item).length === 0" />
                <x-status-component x-show="Object.keys(removeConfirmation.item).length === 0" />
                {{ $slot }}
                <x-progress-component x-show="item.progress !== null && Object.keys(removeConfirmation.item).length === 0" />
                <x-submit-button x-show="Object.keys(removeConfirmation.item).length === 0" />
            </div>
            <span x-show="Object.keys(removeConfirmation.item).length !== 0">
              <x-remove-confirmation />
            </span>
</div>