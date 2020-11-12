<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('images/favicon-32x32.png') }}">

    <title>KeepTrack</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .edit {
            color: black;
        }
    </style>
    @livewireStyles
    {{-- Spruce package:  https://github.com/ryangjchandler/spruce --}}
</head>

<body>
    <div id="app" class="flex-center position-ref h-full mx-4">
        <livewire:nav-bar />
        @if (Auth::check())
        @endif
        <div class="h-full w-full">
            @yield("content")
        </div>
    </div>
    @livewireScripts
    <script defer src="{!! mix('js/app.js') !!}"></script>
</body>

</html>