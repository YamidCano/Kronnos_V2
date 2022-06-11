<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Crear Compra</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('compras') }}">Compras</a></li>
                        <li class="breadcrumb-item">Crear Compra</li>
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
                            <div class="col-md-5">

                            </div>
                            <div class="col-sm-6 col-md-5">
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <div class="mb-3">
                                    <a type="button" class="btn btn-primary mb-3" href="{{ url('compras') }}">
                                        Volver
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr class="m-0">
                        <div class="row mt-4">
                            <div class="col">
                                <label for="Name">Numero Factura *</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-numbered"> </i>
                                    </span>
                                    <input class="form-control" type="text" wire:model="invoiceNumber"
                                        placeholder="Numero Factura *">
                                    @if ($invoiceNumber != null)
                                        <span class="input-group-text" style="cursor:pointer;" wire:click="clean1">
                                            <i class="icofont icofont-close-circled"> </i>
                                        </span>
                                    @endif
                                </div>
                                @error('invoiceNumber')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="Name">Selecione Proveedor *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-fast-delivery"> </i>
                                    </span>
                                    <select class="form-control" wire:model="selectProvider">
                                        <option value="">
                                            Selecione Proveedor *
                                        </option>
                                        @foreach ($providers as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($selectProvider != null)
                                        <span class="input-group-text" style="cursor:pointer;" wire:click="clean2">
                                            <i class="icofont icofont-close-circled"> </i>
                                        </span>
                                    @endif
                                </div>
                                @error('selectProvider')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="Name">Selecione una fecha *</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-calendar"> </i>
                                    </span>
                                    <input class="form-control" type="date" wire:model="date"
                                        placeholder="Numero Factura *">
                                    @if ($date != null)
                                        <span class="input-group-text" style="cursor:pointer;" wire:click="clean3">
                                            <i class="icofont icofont-close-circled"> </i>
                                        </span>
                                    @endif
                                </div>
                                @error('date')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col">
                                <div>
                                    <label for="buscar" class="mb-1">
                                        Seleccione un producto *
                                        {{-- @if ($picked)
                                            <span class="badge bg-success">OK</span>
                                        @else
                                            <span class="badge bg-danger">OK</span>
                                        @endif --}}
                                    </label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="icofont icofont-search"> </i>
                                            </span>
                                            <input wire:model="buscar" wire:keydown.enter="asignarPrimero()" type="text"
                                                class="form-control" id="buscar" autocomplete="off">
                                            @if ($buscar != null)
                                                <span class="input-group-text" style="cursor:pointer;"
                                                    wire:click="close">
                                                    <i class="icofont icofont-close-circled"> </i>
                                                </span>
                                            @endif
                                        </div>
                                        @if (count($product) > 0)
                                            @if (!$picked)
                                                <div style="position: absolute;z-index: 5;width: 93%;"
                                                    class="shadow rounded">
                                                    @foreach ($product as $item)
                                                        <span class="form-control" style="cursor: pointer"
                                                            wire:click="asignarProduct('{{ $item->id }}')">
                                                            {{ $item->name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @else
                                            @if (!empty($buscar))
                                                <span class="form-control text-danger">
                                                    No se han encontrado resultados
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                    @error('buscar')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    @error('idproduct')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                    @if (empty($buscar))
                                        <small class="form-text text-muted">
                                            <div>
                                                Comience digitar para que el resultado aparezca
                                            </div>
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
