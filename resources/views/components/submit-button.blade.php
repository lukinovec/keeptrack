<button
    class="w-1/4 py-1 mx-auto mt-2 text-base bg-gray-700 rounded-lg focus:outline-none hover:bg-gray-900"
    x-show="edit.apiID == item.apiID" x-on:click="submit(item)">
    Submit
</button>