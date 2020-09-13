<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KeepTrack</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    {{-- <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
    </style> --}}
    @livewireStyles
</head>

<body>
    <div id="app" class="flex-center position-ref h-full w-100 mx-4">
        @livewire("nav-bar")
        @if (Auth::check())
        @endif
        <div>
            @yield("content")
        </div>
    </div>
    @livewireScripts
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
</body>

</html>
