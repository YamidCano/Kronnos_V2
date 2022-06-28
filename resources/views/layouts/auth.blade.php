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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles

    @include('layouts.cuba.head')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="page-body">
        @hasSection('content')
            <main>
                @yield('content')
            </main>
        @else
            {{ $slot }}
        @endif
    </div>

    @include('layouts.cuba.plugins')

    @livewireScripts

    @stack('js')



    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script>
        Livewire.on('alert', function(message) {
            Swal.fire(
                'Felicidades',
                message,
                'success'
            )
        });

        Livewire.on('alertError', function(message) {
            Swal.fire(
                '¡Algo no va bien!',
                message,
                'error'
            )
        });
    </script>
</body>

</html>
