<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Crear una venta</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('compras') }}">Compras</a></li>
                        <li class="breadcrumb-item">Crear una venta</li>
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
                                <button type="button" class="btn btn-primary float-end" wire:click="close">
                                    Volver
                                </button>
                            </div>
                        </div>
                        @if ($selectClients == null)
                            <div class="row ">
                                <div class="col">
                                    <label for="Name">Selecione Un Cliente *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-fast-delivery"> </i>
                                        </span>
                                        <select class="form-control" wire:model="selectClients">
                                            <option value="">
                                                Selecione Un Cliente *
                                            </option>
                                            @foreach ($users as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('selectClients')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="Name">&nbsp</label>
                                    <div>
                                        <button class="btn btn-outline-info " type="button" data-bs-toggle="modal"
                                            data-bs-target="#Store" wire:click="createClient">
                                            <i class="icofont icofont-ui-add"> </i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <div class="m-2">
                                        <div class="h6 mt-4">Nombre del Cliente:
                                            <strong>{{ $userName }} {{ $last_name }}</strong>
                                        </div>
                                        <button type="button" wire:click="clean2"
                                            class="btn btn-outline-secundary btn-icon float-end">
                                            <i class="icofont icofont-ui-delete text-danger" style="font-size: 20px;">
                                            </i>
                                        </button>
                                        <div class="h6">Número de Identificación:
                                            <strong>{{ $userIdentification }}</strong>
                                        </div>
                                        <div class="h6">Telefono: <strong>{{ $userPhone }}</strong>
                                        </div>
                                        <div class="h6">Email: <strong>{{ $userEmail }}</strong></div>
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
                            <br>
                            <div class="row ">
                                <div class="col">
                                    <div>
                                        <label for="buscar" class="mb-1">
                                            Seleccione un producto *
                                        </label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="icofont icofont-search"> </i>
                                                </span>
                                                <input wire:model="buscar" wire:keydown.enter="asignarPrimero()"
                                                    type="text" class="form-control" id="buscar" autocomplete="off">
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
                                                                    type="number" value="{{ $item->quantity }}"
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

                                            <tr class="mt-1" style="border-top: 2px solid #ced4da">
                                                <td colspan="3" rowspan="4">
                                                    <textarea wire:model="note" rows="4" cols="4" class="form-control" placeholder="{{ __('Nota') }} "></textarea>
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
                                                        <?php echo number_format(\Cart::session(auth()->user()->id)->getTotal(), 0, ',', '.'); ?>
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
                                                        <select class="form-select " wire:model="idTaxe">
                                                            {{-- <option value="">
                                                                N/A
                                                            </option> --}}
                                                            @foreach ($taxesall as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->name }} -- {{ $item->tax_rate }} %
                                                                </option>
                                                            @endforeach
                                                        </select>
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
                                                        <?php echo number_format(\Cart::session(auth()->user()->id)->getTotal() * $taxRate, 0, ',', '.'); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                @if (count(Cart::session(auth()->user()->id)->getContent()))
                                                    <td class="text-end" colspan="5">
                                                        <button type="button" class="btn btn-primary"
                                                            wire:loading.attr="disabled" wire:target="save"
                                                            wire:click="save">
                                                            Crear Compra
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Crear-->
    <div wire:ignore.self class="modal fade" id="Store" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Crear Cliente
                    </h5>
                    <button type="button" class="btn-close" wire:click="close2" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Nombres *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-user-alt-5"> </i>
                                    </span>
                                    <input type="text" placeholder="Nombres"
                                        class="form-control @error('name') is-invalid @enderror" wire:model="name" />
                                </div>
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Apellidos *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-user-alt-5"> </i>
                                    </span>
                                    <input type="text" placeholder="Apellidos"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        wire:model="last_name" />
                                </div>

                                @error('last_name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Identificacion *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-id"> </i>
                                    </span>
                                    <input type="number" placeholder="Identificacion"
                                        class="form-control @error('identification') is-invalid @enderror"
                                        wire:model="identification" />
                                </div>

                                @error('identification')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">

                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Telefono *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-phone"> </i>
                                    </span>
                                    <input type="number" placeholder="Telefono"
                                        class="form-control @error('phone') is-invalid @enderror" wire:model="phone" />
                                </div>

                                @error('phone')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Correo Electonico *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-email"> </i>
                                    </span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        autocomplete="off" placeholder="email" wire:model="email" />
                                </div>

                                @error('email')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Direccion *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-location-pin"> </i>
                                    </span>
                                    <input type="text" placeholder="Direccion"
                                        class="form-control @error('address') is-invalid @enderror"
                                        wire:model="address" />
                                </div>

                                @error('address')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Ciudad *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-map"> </i>
                                    </span>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                        autocomplete="off" placeholder="Ciudad" wire:model="city" />
                                </div>

                                @error('city')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close2"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="saveClient">Crear Cliente</button>
                </div>
            </div>
        </div>
    </div>
</div>
