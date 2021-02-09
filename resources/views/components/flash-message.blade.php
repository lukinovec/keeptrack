<div class="flex items-center justify-center text-lg font-bold text-blueGray-300" style="position: fixed; left: 50%; top: 15%">
        <span class="relative flex items-center justify-center p-4 space-x-4 bg-green-600 rounded-xxl" style="left: -50%">
            <button wire:click="$set('message', '')" style="width: 30px; height: 30px" class="p-1 font-extrabold bg-green-700 rounded-full">X</button>
            {!! $message !!}
        </span>
</div>