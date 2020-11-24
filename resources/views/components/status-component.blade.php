{{ $slot }} <select class="edit select w-32 font-bold" x-model="item.status" name="status">
    <option value="completed" x-text="statuses['completed']"></option>
    <option value="ptw" x-text="statuses['ptw']"></option>
    <option x-show="item.type != 'movie' && item.type != 'book'" value="watching" x-text="statuses['watching']">
    </option>
    <option value="none">Delete Item</option>
</select>