<span class="flex-1 mx-3">
    <label class="m-1 text-base" for="status">Status</label>
    <select id="status" class="w-40 p-1 bg-transparent border-4 text-blueGray-300 border-blueGray-300 rounded-xxl" x-model="item.status" name="status">
        <option class="text-gray-700" value="completed" x-text="statuses['completed']"></option>
        <option class="text-gray-700" value="ptw" x-text="statuses['ptw']"></option>
        <option class="text-gray-700" x-show="item.type != 'movie'" value="watching" x-text="statuses['watching']"></option>
    </select>
</span>