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
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            min-height: 100%;
            height: 100%;
            padding-top: 0;
            margin: 0;
            background: linear-gradient(to top, #1e293b 0%, #0f172a 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        *:focus {
            outline: none;
        }

        .edit {
            color: rgba(203, 213, 225);
        }

        a:active,
        a:focus,
        button,
        button:active,
        button:focus {
            outline: 0;
            -moz-outline-style: none;
        }

        /* Loader */

        .loader,
        .loader:before,
        .loader:after {
            background: rgba(203, 213, 225);
            -webkit-animation: load1 1s infinite ease-in-out;
            animation: load1 1s infinite ease-in-out;
            width: 1em;
            height: 4em;
        }

        .loader {
            color: rgba(203, 213, 225);
            text-indent: -9999em;
            margin: 88px auto;
            position: relative;
            font-size: 11px;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }

        .loader:before,
        .loader:after {
            position: absolute;
            top: 0;
            content: '';
        }

        .loader:before {
            left: -1.5em;
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .loader:after {
            left: 1.5em;
        }

        @-webkit-keyframes load1 {

            0%,
            80%,
            100% {
                box-shadow: 0 0;
                height: 4em;
            }

            40% {
                box-shadow: 0 -2em;
                height: 5em;
            }
        }

        @keyframes load1 {

            0%,
            80%,
            100% {
                box-shadow: 0 0;
                height: 4em;
            }

            40% {
                box-shadow: 0 -2em;
                height: 5em;
            }
        }

        /* https://stackoverflow.com/questions/22747193/statically-rotate-font-awesome-icons */
        .fa-rotate-45 {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .fa-rotate-45-negative {
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }

        .top-35 {
            top: 35%
        }
        .top-5rem {
            top: 5rem
        }
    </style>
    @livewireStyles
    <script defer src="{!! mix('js/app.js') !!}"></script>
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false" defer></script>
    <meta name="Description" content="KeepTrack - Track progress in your TV shows and books">
</head>

<body class="">
    {{-- <img src="{{ asset('images/tv.png') }}" class="fixed bottom-0 left-0 w-64 opacity-25 fa-rotate-45" />
    <img src="{{ asset('images/book.png') }}" class="fixed bottom-0 right-0 w-64 opacity-50 fa-rotate-45-negative" />
    --}}
    <div id="app"
        class="h-screen flex flex-col mx-4 {{ !str_contains(Request::fullUrl(), '/library') && !str_contains(Request::fullUrl(), '/home') ? 'overflow-hidden' : '' }}">

        <livewire:nav-bar />

        @if (Auth::check())
        @endif
        <div class="flex items-center justify-center flex-1 h-full p-8">
            @yield("content")
        </div>
    </div>
    @livewireScripts

    <script src="https://kit.fontawesome.com/1d34d35411.js" crossorigin="anonymous"></script>
</body>

</html>