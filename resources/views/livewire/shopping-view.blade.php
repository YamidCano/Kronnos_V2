<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Compras</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Compras</li>
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
                            <div class="col-md-3">
                                @can('Shopping - Crear')
                                    <div class="mb-3">
                                        <a type="button" class="btn btn-primary mb-3" href="{{ url('comprasCrear') }}">
                                            Crear Compra
                                        </a>
                                    </div>
                                @endcan
                            </div>
                            <div class="col-sm-6 col-md-7">
                                <div class="row mb-3">
                                    <div class="col input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-search"> </i>
                                        </span>
                                        <input class="form-control" type="search" wire:model="search"
                                            placeholder="Buscar" aria-label="Search">
                                        @if ($search != null)
                                            <span class="input-group-text" style="cursor:pointer;" wire:click="clean">
                                                <i class="icofont icofont-close-circled"> </i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-search"> </i>
                                        </span>
                                        <input class="form-control" type="search" wire:model="search2"
                                            placeholder="Buscar" aria-label="Search">
                                        @if ($search2 != null)
                                            <span class="input-group-text" style="cursor:pointer;" wire:click="clean">
                                                <i class="icofont icofont-close-circled"> </i>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <div class="mb-3">
                                    <select class="form-select digits select2" id="perPage" wire:model="perPage">
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="250">250</option>
                                        <option value="500">500</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover card-table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Numero Factura</th>
                                        <th>Proveedor</th>
                                        <th>Fecha de compra</th>
                                        <th>Estado de compra</th>
                                        <th>Monto de pago</th>
                                        <th>Cantidad total</th>
                                        <th>Estado de pago</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shopping as $item)
                                        <tr>
                                            <td>
                                                {{ $item->invoice_number }}
                                            </td>
                                            <td>
                                                {{ $item->provider->name }}
                                            </td>
                                            <td>
                                                {{ $item->date }}
                                            </td>
                                            <td>
                                                @if ($item->order_status == 0)
                                                    <div class="text-success">
                                                        Recibido
                                                    </div>
                                                @elseif ($item->order_status == 1)
                                                    <div class="text-warning">
                                                        Ordenado
                                                    </div>
                                                @else
                                                    <div class="text-danger">
                                                        Pendiente
                                                    </div>
                                                @endif
                                            </td>
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            {{ $shopping->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
