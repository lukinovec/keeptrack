<div x-show="Object.keys(removeConfirmation.item).length !== 0" class="p-4 m-2 opacity-75 bg-blueGray-900 rounded-xxxl bg-yellow">
    Are you sure you want to remove <span x-text="removeConfirmation.item.name"></span> from your library?
    <span class="flex space-x-4">
        <button class="p-2 btn" x-on:click="confirmRemove(true); $dispatch('item-updated')">Yes</button>
        <button class="p-2 btn" x-on:click="confirmRemove(false)">No</button>
    </span>
</div>