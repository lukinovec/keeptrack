<span class="flex-1 mx-3">
    <label class="m-1 text-base" for="rating">Rating</label>
    {{-- <input id="rating" class="w-10 h-10 p-1 bg-transparent border-4 text-blueGray-300 border-blueGray-300 rounded-xxl" x-model.number="item.rating" type="text" name="rating">/10 --}}
    <select class="w-12 bg-black bg-opacity-25" x-model="item.rating" name="rating" id="rating">
        @for($i = 1; $i <= 10; $i++)
        <option class="text-gray-700 bg-blueGray-300" value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select> / 10
</span>