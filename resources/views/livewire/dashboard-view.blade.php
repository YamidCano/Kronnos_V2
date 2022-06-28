<div>

    <style>

        /******************** Dashboards ********************/
        #caja1 {
            font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;
            color: #000000;
            font-size: 18px;
            text-align: center;
            background: #56B7F5;
            box-shadow: 10px 10px 10px #56B7F595;
            margin: 2.5%;
            border-radius: 35px 0px 35px 0px;
            min-width: 290px;
            max-width: 350px;
            border-bottom: 1px solid;
            border-top: 1px solid;
        }

        #caja1 h1 {
            word-spacing: 10pt;
        }

        #caja2 h2 {
            word-spacing: 10pt;
        }

        #caja3 h1 {
            word-spacing: 10pt;
        }

        #caja2 {
            font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;
            color: #000000;
            font-size: 18px;
            text-align: center;
            background: #F5F387;
            box-shadow: 10px 10px 10px #F5F38795;
            margin: 2.5%;
            border-radius: 35px 0px 35px 0px;
            min-width: 290px;
            max-width: 350px;
            border-bottom: 1px solid;
            border-top: 1px solid;
        }

        #caja3 {
            font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;
            color: #000000;
            font-size: 18px;
            text-align: center;
            background: #F56E6E;
            box-shadow: 10px 10px 10px #F56E6E95;
            margin: 2.5%;
            border-radius: 35px 0px 35px 0px;
            min-width: 290px;
            max-width: 350px;
            border-bottom: 1px solid;
            border-top: 1px solid;
        }

        #caja4 {
            font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;
            color: black;
            text-align: center;
            background: #f8f9fa;
            margin: 2.5%;
            box-shadow: 10px 10px 10px grey;
            min-width: 300px;
            max-width: 450px;
            border-radius: 35px 0px 35px 0px;
            border-bottom: 1px solid;
            border-top: 1px solid;
        }

        #caja5 {
            font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;
            color: black;
            text-align: center;
            background: #f8f9fa;
            margin: 1.5%;
            box-shadow: 10px 10px 10px grey;
            min-width: 300px;
            max-width: 450px;
            height: 230px;
            border-radius: 35px 0px 35px 0px;
            border-bottom: 1px solid;
            border-top: 1px solid;
        }

        #scroll {
            overflow: scroll;
            max-height: 250px;
            overflow-x: unset;
            scroll-behavior: smooth;
            /* background: #f5f3f3; */
            max-width: 450px;
        }

        #table td:hover {
            background-color: #00000070;
        }

        #progress {
            height: 26px;
            width: 70%;
            border-radius: 30px;
            border: black 1px solid;
            float: left;
        }

        #progress h5 {
            font-weight: bold;
        }

    </style>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Dashboard </h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        {{-- <li class="breadcrumb-item">Dashboard </li> --}}
                        {{-- <li class="breadcrumb-item active">Sample Page</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- {!! Avatar::create(Auth::user()->name)->setFontSize(20)->setDimension(40)->toSvg(); !!} --}}


    @if (is_null($rol))
        <div class="card">
            <div class="row justify-content-center">
                <div id="caja1" class="col-3">
                    <h3>Total a Pagar</h3>
                    <h1 data-toggle="tooltip" data-placement="top" title="Numero de cuotas pagadas">
                        $ <?php echo number_format($invoicesTotal, 0, ',', '.'); ?>
                        <span class="livicon" data-name="piggybank" data-c="black" data-s="60" data-loop="true"
                            data-hovercolor="black"></span>
                    </h1>
                </div>
                <div id="caja2" class="col-3">
                    <h3>Saldo Pendiente</h3>
                    <h2 data-toggle="tooltip" data-placement="top" title="Saldo Pendiente">
                        $ <?php echo number_format($balance, 0, ',', '.'); ?>
                        <span class="livicon" data-name="money" data-c="black" data-s="60" data-loop="true"
                            data-hovercolor="black"></span>
                    </h2>
                </div>
                <div id="caja3" class="col-3">
                    <h3>Total de pedidos</h3>
                    <h1 data-toggle="tooltip" data-placement="top" title="Numero de cuotas por pagar">
                        {{ $invoicesCont}}
                        <span class="livicon" data-name="credit-card" data-c="black" data-s="60" data-loop="true"
                            data-hovercolor="black"></span>
                    </h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div id="caja5" class="col-5">
                    <div>
                        <h3>Total pagado</h3>
                        <br>
                        <div data-toggle="tooltip" data-placement="top" title="Credito Disponible">
                            <div class="progress" id="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{$percent}}%;">{{ $percent}} %</div>
                            </div>
                            <div>
                                <h5>$ <?php echo number_format($paymentEntry, 0, ',', '.'); ?> </h5>
                            </div>
                        </div>
                        <br>
                        <h3>
                            Total a Pagar $ <?php echo number_format($invoicesTotal, 0, ',', '.'); ?>
                        </h3>
                    </div>
                </div>

                <div id="scroll" class="col-5">
                    <div id="caja4">
                        <table id="table" class="table">
                            <h3>Historial de Pedidos</h3>
                            <thead>
                                <tr>
                                    <th>
                                        Precio
                                    </th>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Factura
                                    </th>
                                </tr>
                            </thead>

                            @foreach ($invoices as $item)
                                <tr>
                                    <td>
                                        $ <?php echo number_format($item->total, 0, ',', '.'); ?>
                                    </td>
                                    <td>{{ $item->date }}</td>
                                    <td><a target="_blank"
                                            href="{{ route('VentasDetalle', $item->slug) }}">{{ $item->invoice_number }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <br>
        </div>
        <br>
    @else
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            Dashboard
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Container-fluid Ends-->
</div>
