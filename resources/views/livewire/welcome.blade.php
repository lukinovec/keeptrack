<div class="text-center p-4 mt-64 md:p-8 text-blueGray-300">
    <div class="text-3xl md:text-6xl font-bold">Welcome to KeepTrack! TESTING</div>
    @guest
    <div class="login mt-8">
        <a href="/login" class="btn p-2">Log
            in</a> to
        your account
        <div class="m-4">or</div>
    </div>
    <div class="register">
        <a href="/register" class="btn p-2">Register</a>
        if you don't have one
    </div>
    @endguest

    @auth
    <div class="continue my-8">
        <a href="/home" class="btn p-3">Continue</a>
    </div>
    @endauth
</div>