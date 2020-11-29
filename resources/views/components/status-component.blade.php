{{ $slot }} <select
    class="edit select bg-transparent text-center border-2 border-r-0 text-blueGray-300 border-blueGray-300 w-32"
    x-model="item.status" name="status">
    <option class="bg-blueGray-700 text-blueGray-300" value="completed" x-text="statuses['completed']"></option>
    <option class="bg-blueGray-700 text-blueGray-300" value="ptw" x-text="statuses['ptw']"></option>
    <option class="bg-blueGray-700 text-blueGray-300" x-show="item.type != 'movie'" value="watching"
        x-text="statuses['watching']">
    </option>
    <option class="bg-red-700" value="none">Delete Item</option>
</select>