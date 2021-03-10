<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- User data -->

    @if(auth()->user())
    <script class="hidden">
    // if you want to put data under "" don't forget to cast to int id otherwise there'll be bugs for real-time rendering
        window.User = {
            id: {{ auth()->user()->id ?? '' }},
            avatar: "{{ optional(auth()->user())->avatar() ?? '' }}",
            username: "{{auth()->user()->username ?? ''}}",
            name: "{{auth()->user()->name ?? ''}}"
        };

    </script>
    @endif

</head>
<body>
    <div id="app">
        <main class="container mx-auto">
            @yield('content')

        </main>
    </div>
</body>
</html>
