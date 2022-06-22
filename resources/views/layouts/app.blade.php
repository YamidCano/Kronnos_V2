<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    @include('layouts.cuba.head')

    @livewireStyles

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        textarea:focus,
        select:focus,
        input:focus,
        input[type]:focus {
            /* border: none; */
            border: 1px solid #ced4da;
            box-shadow: 0 2px 2px rgba(229, 37, 23, 0.075)inset, 0 0 8px #e74d3c00;
            outline: 0 none;
        }

        .form-select:focus {
            border-bottom: 3px solid #e74d3c00;
            outline: 0;
            /* border: none; */
            -webkit-box-shadow: 0 0 0 .25rem rgba(13, 110, 253, 0.25);
            box-shadow: 0 2px 2px rgba(229, 37, 23, 0.075)inset, 0 0 8px #e74d3c00;
        }
    </style>

</head>

<body onload="startTime()" @if (auth()->user()->theme == 1) class="dark-only" @endif>
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('layouts.cuba.header')
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('layouts.cuba.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body mb-5">
                @hasSection('content')
                    <main>
                        @yield('content')
                    </main>
                @else
                    {{ $slot }}
                @endif
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('layouts.cuba.footer')
        </div>
    </div>

    @livewireScripts

    {{-- <script type="module">
        import hotwiredTurbo from 'https://cdn.skypack.dev/@hotwired/turbo';
    </script>

    <script src="https://cdn.jsdelivr.net/npm/livewire-turbolinks@0.1.x/dist/livewire-turbolinks.min.js"
        data-turbolinks-eval="false" data-turbo-eval="false"></script> --}}

    @include('layouts.cuba.plugins')

    @stack('js')



    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script>
        Livewire.on('alert', function(message) {
            Swal.fire(
                '¡Buen trabajo!',
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

        window.livewire.on('Store', () => {
            $('#Store').modal('hide');
        });

        window.livewire.on('update', () => {
            $('#update').modal('hide');
        });

        window.livewire.on('view', () => {
            $('#update').modal('hide');
        });

        Livewire.on('toastAlert', function(message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: message,
            })

        });

        Livewire.on('toastAlertError', function(message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: message,
            })

        });
    </script>
</body>

</html>
