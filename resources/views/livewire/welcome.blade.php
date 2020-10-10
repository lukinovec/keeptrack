<div class="text-center h-full pt-40 text-2xl">
    <span class="text-6xl font-bold">Welcome to KeepTrack!</span>
    @if (!Auth::check())
    <div class="login my-8">
        <a href="/login" class="border-b-2 hover:border-black hover:text-black">Log in</a> to your account
        <div class="mt-4">or</div>
    </div>
    <div class="register my-8">
        <a href="/register" class="border-b-2 hover:border-black hover:text-black">Register</a>
        if you don't have one
    </div>
    @else
    <div class="continue my-8">
        <a href="/home" class="border-b-2 hover:border-black hover:text-black">Continue</a>
    </div>
    @endif
</div>