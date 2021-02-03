<div class="absolute z-10 flex flex-col w-full h-full pb-32 text-left sm:pb-56" x-show="edit.apiID == item.apiID || removeConfirmation.item.apiID == item.apiID"
            style="top: 25%">
                <x-rating-component x-show="Object.keys(removeConfirmation.item).length === 0" />
                <x-note-component x-show="Object.keys(removeConfirmation.item).length === 0" />
                {{ $slot }}
                <x-submit-button x-show="Object.keys(removeConfirmation.item).length === 0" />
            <span x-show="Object.keys(removeConfirmation.item).length !== 0">
              <x-remove-confirmation />
            </span>
</div>