<button title="Click to save"
    class="w-1/4 py-1 mx-auto mt-2 text-base bg-gray-900 rounded-lg shadow-2xl focus:outline-none hover:bg-gray-800"
    x-show="edit.apiID == item.apiID" x-on:click="submit(item); $dispatch('item-updated')">
    Save
</button>