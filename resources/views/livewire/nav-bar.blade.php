<div class="flex flex-row">
    @if (Auth::check())
    <div class="p-6 text-xl">
        <a href="/home" class="flex-1 border-b-2 mx-6 hover:border-black hover:text-black">Home</a>
        <a href="#" wire:click="logout" class="border-b-2 mx-6 hover:border-black hover:text-black">Log out</a>
    </div>
    @elseif (Request::url() != "http://127.0.0.1:8000")
    <a href="/" class="text-3xl mx-6 hover:text-black">Home</a>
    @endif
</div>