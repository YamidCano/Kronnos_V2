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
                                        <input class="form-control" type="search" wire:model="search2"
                                            placeholder="Buscar Numero Factura" aria-label="Search">
                                        @if ($search2 != null)
                                            <span class="input-group-text" style="cursor:pointer;" wire:click="clean2">
                                                <i class="icofont icofont-close-circled"> </i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-search"> </i>
                                        </span>
                                        <input class="form-control" type="search" wire:model="search"
                                            placeholder="Buscar Proveedor" aria-label="Search">
                                        @if ($search != null)
                                            <span class="input-group-text" style="cursor:pointer;" wire:click="clean1">
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
                                        {{-- <th>Estado de compra</th> --}}
                                        <th>Monto Pagado</th>
                                        <th>Cantidad total</th>
                                        <th>Estado de pago</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shopping as $item)
                                        <tr>
                                            <td>
                                                <a type="button" href="{{ route('compraDetalle', $item->slug) }}">
                                                    {{ $item->invoice_number }}
                                                </a>

                                            </td>
                                            <td>
                                                {{ $item->provider->name }}
                                            </td>
                                            <td>
                                                {{ $item->date }}
                                            </td>
                                            {{-- <td>
                                                @if ($item->order_status == 0)
                                                    <div class="text-success">
                                                        Ordenado
                                                    </div>
                                                @elseif ($item->order_status == 1)
                                                    <div class="text-warning">
                                                        Pendiente
                                                    </div>
                                                @else
                                                    <div class="text-danger">
                                                        Recibido
                                                    </div>
                                                @endif
                                            </td> --}}
                                            <td>
                                               $ <?php echo number_format($item->sum, 0, ',', '.'); ?>
                                            </td>
                                            <td>
                                               $ <?php echo number_format($item->total, 0, ',', '.'); ?>
                                            </td>
                                            <td>
                                                @if ($item->sum == 0)
                                                    <div class="badge badge-danger">
                                                        No pagado
                                                    </div>
                                                @elseif ($item->sum < $item->total)
                                                    <div class="badge badge-info">
                                                        Parcialmente pagado
                                                    </div>
                                                @elseif ($item->sum == $item->total)
                                                    <div class="badge badge-success">
                                                        Pagada
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <button
                                                    class="btn @if ($item->sum == 0) btn-outline-danger @elseif ($item->sum == $item->total) btn-outline-success  @else  btn-outline-info @endif "
                                                    type="button" wire:click="appMoney({{ $item->id }})"
                                                    wire:target="edit" data-bs-toggle="modal" data-bs-target="#update">
                                                    @if ($item->sum == $item->total)
                                                        <i class="icofont icofont-paper"> </i>
                                                    @else
                                                        <i class="icofont icofont-money"> </i>
                                                    @endif
                                                </button>
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

    <!-- Modal  Money-->
    <div wire:ignore.self class="modal fade" id="update" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        @if ($this->total - $this->paymentsum != 0)
                            Agregar nuevo pago
                        @else
                            Informe de pago
                        @endif
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="Name">Monto a pagar</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="icofont icofont-money"> </i>
                                </span>
                                <div class="form-control bg-danger bg-gradient">
                                    $ <?php echo number_format($total, 0, ',', '.'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="Name">Monto Pagado</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="icofont icofont-money"> </i>
                                </span>
                                <div class="form-control bg-success bg-gradient">
                                    $ <?php echo number_format($paymentsum, 0, ',', '.'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="Name">Restante a pagar</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="icofont icofont-money"> </i>
                                </span>
                                <div class="form-control bg-info bg-gradient">
                                    $ <?php echo number_format($total - $paymentsum, 0, ',', '.'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($this->total - $this->paymentsum != 0)
                        <hr>
                        <form>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="Name">Monto a pagar *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-money"> </i>
                                        </span>
                                        <input type="number" placeholder="Monto a pagar *"
                                            class="form-control @error('paymenAmount') is-invalid @enderror"
                                            wire:model="paymenAmount" />
                                        <span class="input-group-text" style="cursor:pointer;" wire:click="total">
                                            Todo
                                        </span>
                                    </div>
                                    @error('paymenAmount')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="Name">Fecha *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-calendar"> </i>
                                        </span>
                                        <input type="date" placeholder="Fecha *"
                                            class="form-control @error('paymentDate') is-invalid @enderror"
                                            wire:model="paymentDate" />
                                    </div>
                                    @error('paymentDate')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="Name">Selecione Modo De Pago *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-cubes"> </i>
                                        </span>
                                        <select class="form-control" wire:model="paymentMode">
                                            <option value="">
                                                Selecione Modo De Pago *
                                            </option>
                                            @foreach ($paymentModes as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('paymentMode')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="Name">Nota</label>
                                    <div class="input-group">
                                        <textarea wire:model="paymentNote" rows="2" cols="1" class="form-control" placeholder="{{ __('Nota') }} "></textarea>
                                    </div>
                                    @error('paymentNote')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <button type="button" class="btn btn-primary" wire:click="save">
                                        Agregar
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th>Monto Pagado</th>
                                    <th>Fecha</th>
                                    <th>Modo De Pago</th>
                                    <th>Nota</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentOut as $item)
                                    <tr>
                                        <td>
                                            <?php echo number_format($item->amount, 0, ',', '.'); ?>
                                        </td>
                                        <td>
                                            {{ $item->date }}
                                        </td>
                                        <td>
                                            {{ $item->MedioPago->name }}
                                        </td>
                                        <td>
                                            {{ $item->note }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $paymentOut->links() }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">Cerrar</button>
                    {{-- <button type="button" class="btn btn-primary" wire:click="save">Crear</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
