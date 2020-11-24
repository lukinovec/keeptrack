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
            height: 100%;
            margin: 0;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .edit {
            color: rgba(203, 213, 225);
        }

        a:active,
        a:focus {
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
    </style>
    @livewireStyles
</head>

<body class="bg-gradient-secondary">
    <div id="app" class="flex-center position-ref h-full mx-4">
        @if (!Route::is("welcome"))
        <livewire:nav-bar />
        @endif

        @if (Auth::check())
        @endif
        <div class="flex justify-center">
            @yield("content")
        </div>
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false"></script>
    <script defer src="{!! mix('js/app.js') !!}"></script>
</body>

</html>