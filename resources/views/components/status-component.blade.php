<span class="flex-1 mx-3">
    Status: <select class="edit w-32" x-model="item.status" name="status">
        <option value="completed" x-text="statuses['completed']"></option>
        <option value="ptw" x-text="statuses['ptw']"></option>
        <option x-show="item.type != 'movie' && item.type != 'book'" value="watching" x-text="statuses['watching']">
        </option>
        <option value="none">Delete Item</option>
    </select>
</span>