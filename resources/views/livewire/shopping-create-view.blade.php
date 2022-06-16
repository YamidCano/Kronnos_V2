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
                            <div>
                                <a type="button" class="btn btn-primary float-end" href="{{ url('compras') }}">
                                    Volver
                                </a>
                            </div>
                        </div>
                        @if ($selectProvider == null)
                            <div class="row ">
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
                                        @error('selectProvider')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <div class="m-2">
                                        <div class="h6 mt-4">Nombre del Proveedor:
                                            <strong>{{ $providerName }}</strong>
                                        </div>
                                        <button type="button" wire:click="clean2"
                                            class="btn btn-outline-secundary btn-icon float-end">
                                            <i class="icofont icofont-ui-delete text-danger" style="font-size: 20px;">
                                            </i>
                                        </button>
                                        <div class="h6">Rut: <strong>{{ $providerRut }}</strong></div>
                                        <div class="h6">Telefono: <strong>{{ $providerPhone }}</strong>
                                        </div>
                                        <div class="h6">Email: <strong>{{ $providerEmail }}</strong></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col mt-4">
                                        <label for="Name">Numero Factura *</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">
                                                <i class="icofont icofont-numbered"> </i>
                                            </span>
                                            <input class="form-control" type="text" wire:model="invoiceNumber"
                                                placeholder="Numero Factura *">
                                            @if ($invoiceNumber != null)
                                                <span class="input-group-text" style="cursor:pointer;"
                                                    wire:click="clean1">
                                                    <i class="icofont icofont-close-circled"> </i>
                                                </span>
                                            @endif
                                        </div>
                                        @error('invoiceNumber')
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
                                                <span class="input-group-text" style="cursor:pointer;"
                                                    wire:click="clean3">
                                                    <i class="icofont icofont-close-circled"> </i>
                                                </span>
                                            @endif
                                        </div>
                                        @error('date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif


                        <br>
                        <div class="row ">
                            <div class="col">
                                <div>
                                    <label for="buscar" class="mb-1">
                                        Seleccione un producto * {{ $idproduct }}
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
                        <br>
                        <div class="row">
                            <div class="order-history table-responsive wishlist">
                                <table class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th>Nombre Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Acciones</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($ordeproducts as $key => $item)
                                            <tr class="text-center" wire:key={{$key}}>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>
                                                    {{ $item['name']}}
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                        @foreach ($Cart->sortBy('id') as $key => $item)
                                            <tr class="text-center">
                                                <td>
                                                    <div class="product-name">
                                                        {{ $item->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo number_format($item->price, 0, ',', '.'); ?>
                                                </td>
                                                <td>
                                                    <fieldset class="qty-box" style="width: 140px">
                                                        <div class="input-group bootstrap-touchspin">
                                                            <button
                                                                class="btn btn-primary btn-square bootstrap-touchspin-down"
                                                                type="button"
                                                                wire:click="quantitymenos({{ $item->id }}, {{ $item->quantity }})">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                            {{-- <span class="input-group-text bootstrap-touchspin-prefix"
                                                                style="display: none;"></span> --}}
                                                            <input class=" text-center form-control"
                                                                id="v{{ $item->id }}"
                                                                wire:change="quantityChange({{ $item->id }}, $('#v' + {{ $item->id }}).val())"
                                                                type="text" value="{{ $item->quantity }}"
                                                                style="display: block;">
                                                            {{-- <label class="touchspin text-center mt-2" style="display: block;">
                                                                <strong>{{ $item->quantity }}</strong>
                                                            </label> --}}
                                                            {{-- <span class="input-group-text bootstrap-touchspin-postfix"
                                                                style="display: none;"></span> --}}
                                                            <button
                                                                class="btn btn-primary btn-square bootstrap-touchspin-up"
                                                                type="button"
                                                                wire:click="quantityMas({{ $item->id }}, {{ $item->quantity }})">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </fieldset>
                                                </td>
                                                <td>
                                                    <button type="button" wire:click="delete({{ $item->id }})"
                                                        class="btn btn-outline-secundary btn-icon ">
                                                        <i class="icofont icofont-ui-delete text-danger"
                                                            style="font-size: 20px;">
                                                        </i>
                                                    </button>

                                                </td>
                                                <td>
                                                    <?php echo number_format(
                                                        \Cart::session(auth()->user()->id)
                                                            ->get($item->id)
                                                            ->getPriceSum(),
                                                        0,
                                                        ',',
                                                        '.',
                                                    ); ?>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" rowspan="3">
                                                <div class="form-floating">
                                                    <label for="floatingTextarea">{{ __('Nota') }}</label>
                                                    <textarea wire:model="des_activity" rows="1" cols="1" class="form-control" placeholder="{{ __('Nota') }} "></textarea>
                                                </div>
                                            </td>
                                            <td class="total-amount">
                                                <h6 class="m-0 text-end">
                                                    <span class="f-w-600">
                                                        Impuesto:
                                                    </span>
                                                </h6>
                                            </td>
                                            <td>
                                                <span>
                                                    <select class="form-select " wire:model="idTaxe">
                                                        <option value="">
                                                            Selecione
                                                        </option>
                                                        @foreach ($taxesall as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->tax_rate }}</option>
                                                        @endforeach
                                                    </select>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="total-amount">
                                                <h6 class="m-0 text-end">
                                                    <span class="f-w-600">
                                                        Total Precio:
                                                    </span>
                                                </h6>
                                            </td>
                                            <td>
                                                <span>
                                                    <?php echo number_format(\Cart::session(auth()->user()->id)->getTotal() * 1.19, 0, ',', '.'); ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-end" colspan="5">
                                                <button type="button" class="btn btn-primary"
                                                    wire:loading.attr="disabled" wire:target="save" wire:click="save">
                                                    Crear Venta
                                                </button>
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
