<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Ajuste de Stock</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Ajuste de Stock</li>
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
                                @can('Proveedor - Crear')
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                            data-bs-target="#Store">
                                            Agregar Nuevo Ajuste de Stock
                                        </button>
                                    </div>
                                @endcan
                            </div>
                            <div class="col-sm-6 col-md-5">
                                <div class="mb-3">
                                    <div class="input-group mb-3">
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
                                        <th>Producto</th>
                                        <th>Usuario</th>
                                        <th>Cantidad</th>
                                        <th>Tipo de ajuste</th>
                                        <th>Nota</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventories as $item)
                                        <tr>
                                            <td>
                                                {{ $item->producto->name }}
                                            </td>
                                            <td>
                                                {{ $item->usuario->name }}
                                            </td>
                                            <td>
                                                @if ($item->type == 0)
                                                    <div class="text-success">
                                                        + {{ $item->quantity }}
                                                    </div>
                                                @else
                                                    <div class="text-danger">
                                                        - {{ $item->quantity }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->type == 0)
                                                    <div class="text-success">
                                                        Agregar
                                                    </div>
                                                @else
                                                    <div class="text-danger">
                                                        Sustraer
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->comments }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            {{ $inventories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="Store" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Nuevo Ajuste de Stock
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row row-sm">
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
                                            <span class="input-group-text" style="cursor:pointer;" wire:click="close">
                                                <i class="icofont icofont-close-circled"> </i>
                                            </span>
                                        @endif
                                    </div>
                                    @if (count($product) > 0)
                                        @if (!$picked)
                                            @foreach ($product as $item)
                                                <span class="form-control" style="cursor: pointer"
                                                    wire:click="asignarProduct('{{ $item->id }}')">
                                                    {{ $item->name }}
                                                </span>
                                            @endforeach
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
                        <br>
                        @if ($idproduct != null)
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="Name">Stock Actual</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-cubes"> </i>
                                        </span>
                                        <input type="number" placeholder="Stock Actual" disabled
                                            class="form-control @error('stockproducto') is-invalid @enderror"
                                            wire:model="stockproducto" />
                                    </div>
                                    @error('name')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="Name">Stock *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-cubes"> </i>
                                        </span>
                                        <input type="number" placeholder="Stock *"
                                            class="form-control @error('quantity') is-invalid @enderror"
                                            wire:model="quantity" />
                                    </div>
                                    @error('quantity')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="Name">{{ __('Tipo de ajuste') }} *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-maximize"> </i>
                                        </span>
                                        <select wire:model="type"
                                            class="form-control @error('type') is-invalid @enderror">
                                            <option value="0">Agregar</option>
                                            <option value="1">Sustraer</option>
                                        </select>
                                    </div>

                                    @error('type')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="Name">Nota</label>
                                    <textarea wire:model="comments" rows="3" cols="20" class="form-control @error('comments') is-invalid @enderror"
                                        placeholder="{{ __('Nota') }}"></textarea>
                                    @error('comments')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">Cerrar</button>
                    @if ($idproduct != null)
                        <button type="button" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:target="updatestock" wire:click="updatestock">Crear</button>
                    @endif
                </div>
            </div>
        </div>
    </div>



</div>
