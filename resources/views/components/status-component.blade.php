<span class="flex-1 mx-3">
    <label class="m-1 text-base" for="status">Status</label>
    <select id="status" class="w-40 p-1 bg-transparent border-4 text-blueGray-300 border-blueGray-300 rounded-xxl" x-model="item.status" name="status">
        <option class="text-gray-700" value="completed" x-text="item.statuses['completed']"></option>
        <option class="text-gray-700" value="planning" x-text="item.statuses['planning']"></option>
        <option class="text-gray-700" x-show="item.type != 'movie'" value="in_progress" x-text="item.statuses['in_progress']"></option>
    </select>
</span>