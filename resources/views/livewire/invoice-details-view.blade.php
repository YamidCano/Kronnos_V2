<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Crear Venta</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('ventas') }}">Ventas</a></li>
                        <li class="breadcrumb-item">Crear Ventas</li>
                        {{-- <li class="breadcrumb-item active">Sample Page</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="mt-2">
                                    @if ($paymentOut == 0)
                                        <div style="position: absolute;" id="bg-text"
                                            class="bg-danger text-center text-white float-none">
                                            <div class="me-5 ms-5">
                                                No pagado
                                            </div>
                                        </div>
                                    @elseif ($paymentOut < $total)
                                        <div style="position: absolute;" id="bg-text"
                                            class="bg-info text-center text-white float-none">
                                            <div class="me-5 ms-5">
                                                Par. pagado
                                            </div>
                                        </div>
                                    @elseif ($paymentOut == $total)
                                        <div style="position: absolute;" id="bg-text"
                                            class="bg-success text-center text-white float-left">
                                            <div class="me-5 ms-5">
                                                Pagada
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-9">
                                <button type="button" class="btn btn-primary float-end" wire:click="close">
                                    Volver
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-4">
                                <div class="m-2">
                                    <div class="h6 mt-4">Nombre del Proveedor:
                                        <strong>{{ $providerName }}</strong>
                                    </div>
                                    <div class="h6">Rut: <strong>{{ $providerRut }}</strong></div>
                                    <div class="h6">Telefono: <strong>{{ $providerPhone }}</strong>
                                    </div>
                                    <div class="h6">Email: <strong>{{ $providerEmail }}</strong></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col mt-4">
                                    <label for="Name">Numero Factura</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-numbered"> </i>
                                        </span>
                                        <div class="form-control">
                                            {{ $invoiceNumber }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="Name">Fecha Factura</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-calendar"> </i>
                                        </span>
                                        <div class="form-control">
                                            {{ $date }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="order-history table-responsive wishlist">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th colspan="2">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shoppingDetails as $item)
                                            <tr class="text-center">
                                                <td>
                                                    <div class="product-name">
                                                        {{ $item->productsName->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo number_format($item->price, 0, ',', '.'); ?>
                                                </td>
                                                <td>
                                                    {{ $item->quantity }}
                                                </td>
                                                <td colspan="2">
                                                    <?php echo number_format($item->total, 0, ',', '.'); ?>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr class="mt-1" style="border-top: 2px solid #ced4da">
                                            <td colspan="3" rowspan="4">
                                                <div class="form-control">
                                                    {{ $note }}
                                                </div>

                                            </td>
                                        </tr>
                                        <tr class="mt-1" style="border-top: 2px solid #ced4da">
                                            <td class="total-amount">
                                                <h6 class="m-0 text-end">
                                                    <span class="f-w-600">
                                                        Sub Total:
                                                    </span>
                                                </h6>
                                            </td>
                                            <td>
                                                <span>
                                                    <?php echo number_format($Subtotal, 0, ',', '.'); ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="total-amount">
                                                <h6 class="m-0 text-end">
                                                    <span class="f-w-600">
                                                        Impuesto:
                                                    </span>
                                                </h6>
                                            </td>
                                            <td>
                                                <span>
                                                    {{ $nameTaxe }} -- {{ $taxRate }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr style="border-top: 2px solid #ced4da">
                                            <td class="total-amount">
                                                <h6 class="m-0 text-end">
                                                    <span class="f-w-600">
                                                        Total:
                                                    </span>
                                                </h6>
                                            </td>
                                            <td>
                                                <span>
                                                    <?php echo number_format($total, 0, ',', '.'); ?>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
