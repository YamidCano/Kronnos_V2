<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PRUEBA DE LIBRERIA</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/css/bootstrap.min.css'>
    <style>
        .invoice-head td {
            padding: 0 8px;
        }

        .container {
            padding-top: 30px;
        }

        .invoice-body {
            background-color: transparent;
        }

        .invoice-thank {
            margin-top: 60px;
            padding: 5px;
        }

        address {
            margin-top: 15px;
        }
    </style>
    @livewireStyles
</head>

<body>


    @livewire('printshopping-view', ['slug' => $slug])

    @livewireScripts
    {{-- @include('layouts.cuba.plugins') --}}

    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/js/bootstrap.min.js'></script>
</body>

</html>
