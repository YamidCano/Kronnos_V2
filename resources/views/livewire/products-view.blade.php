<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Productos</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Productos</li>
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
                                            Crear Producto
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
                                        <th>Nombres Producto</th>
                                        <th>Categoria</th>
                                        <th>Marca</th>
                                        <th>Codigo</th>
                                        <th>Precio Compra</th>
                                        <th>Precio Venta</th>
                                        <th>Stock</th>
                                        <th>Imagen</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->categoria->name }}
                                            </td>
                                            <td>
                                                {{ $item->brands->name }}
                                            </td>
                                            <td>
                                                {{ $item->code }}
                                            </td>
                                            <td>
                                                {{ $item->price }}
                                            </td>
                                            <td>
                                                {{ $item->price_sale }}
                                            </td>
                                            <td>
                                                {{ $item->stock }}
                                            </td>
                                            <td>
                                                {{ $item->count_products }}
                                            </td>
                                            <td style="cursor:pointer;" wire:click="modalPhoto({{ $item->id }})"
                                                data-bs-toggle="modal" wire:target="edit"
                                                data-bs-target="#PhotoCharacter">
                                                <i class="fa fa-file-image-o"></i>
                                            </td>
                                            <td>
                                                <div class="">
                                                    @can('Proveedor - Editar')
                                                        <button type="button" class="btn btn-info"
                                                            wire:click="edit({{ $item->id }})" wire:target="edit"
                                                            data-bs-toggle="modal" data-bs-target="#update">
                                                            <i class="icofont icofont-ui-edit"></i>
                                                        </button>
                                                    @endcan
                                                    @if ($item->count_products == 0)
                                                        @can('Proveedor - Eliminar')
                                                            <button type="button" class="btn btn-danger"
                                                                wire:click="$emit('remove', {{ $item->id }})"
                                                                data-bs-toggle="modal" data-bs-target="#permissionModal">
                                                                <i class="icofont icofont-ui-delete"></i>
                                                            </button>
                                                        @endcan
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <style>
        .img-100 {
            width: 100%;
            height: 100%
        }
    </style>

    <!-- Modal photo Character-->
    <div wire:ignore.self class="modal fade" id="PhotoCharacter" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Image
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg text-center">
                            <img src="{{ Storage::url($modalPhoto) }}" class="img-100 img-fluid"
                                alt="Responsive image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">{{ __('Cerrar') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Crear-->
    <div wire:ignore.self class="modal fade" id="Store" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Crear Producto
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Nombres Producto *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-ui-file"> </i>
                                    </span>
                                    <input type="text" placeholder="Nombres Producto *"
                                        class="form-control @error('name') is-invalid @enderror" wire:model="name" />
                                </div>
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Selecione Una Categoria *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-cubes"> </i>
                                    </span>
                                    <select class="form-control" wire:model="selectcategory">
                                        <option value="">
                                            Selecione Una Categoria *
                                        </option>
                                        @foreach ($product_category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('selectcategory')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Stock Incial *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-memorial"> </i>
                                    </span>
                                    <input type="number" placeholder="Stock Incial *"
                                        class="form-control @error('stock') is-invalid @enderror" wire:model="stock" />
                                </div>

                                @error('stock')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Selecione Marca *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-book-mark"> </i>
                                    </span>
                                    <select wire:model="selectbrands"
                                        class="form-control @error('selectbrands') is-invalid @enderror">
                                        <option value="">{{ __('Selecione Marca') }} *</option>
                                        @foreach ($brands as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('selectbrands')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Codigo Producto *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="cursor:pointer;" wire:click="codeg">
                                        <i class="icofont icofont-bar-code"> </i>
                                    </span>
                                    <input type="number" placeholder="Codigo Producto *"
                                        class="form-control @error('code') is-invalid @enderror" wire:model="code" />
                                </div>
                                @error('code')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Precio Compra*</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-price"> </i>
                                    </span>
                                    <input type="number" step="0.01" placeholder="Precio Compra *"
                                        class="form-control @error('price') is-invalid @enderror" wire:model="price" />
                                </div>
                                <label class="mt-2 text-danger">
                                    @if ($price != null)
                                        $ <?php echo number_format($price, 0, ',', '.'); ?> <br>
                                    @endif
                                </label>
                                @error('price')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">{{ __('Desactivar productos?') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-toggle-off"> </i>
                                    </span>
                                    <select wire:model="status"
                                        class="form-control @error('status') is-invalid @enderror">
                                        <option value="0">NO</option>
                                        <option value="1">SI</option>
                                    </select>
                                </div>
                                @error('status')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Precio Venta*</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-price"> </i>
                                    </span>
                                    <input type="number" step="0.01" placeholder="Precio Compra *"
                                        class="form-control @error('priceSale') is-invalid @enderror" wire:model="priceSale" />
                                </div>
                                <label class="mt-2 text-danger">
                                    @if ($priceSale != null)
                                        $ <?php echo number_format($priceSale, 0, ',', '.'); ?> <br>
                                    @endif
                                </label>
                                @error('priceSale')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Descripción *</label>
                                <textarea wire:model="description" rows="3" cols="20" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="{{ __('Descripción') }} *"></textarea>
                                @error('description')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Selecione un Imgen *</label>
                                @if ($photo)
                                    <br>
                                    <button type="button" class="btn-close" wire:click="cancelimg2"
                                        aria-label="Close"></button>

                                    <button wire:loading wire:target="photo" class="btn btn-primary" type="button"
                                        disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        <span class="visually-hidden">Loading...</span>
                                    </button>
                                    <div class="col-lg text-center">
                                        <img src="{{ $photo->temporaryUrl() }}" class="img-100 img-fluid"
                                            alt="Responsive image">
                                    </div>
                                @else
                                    <input type="file" placeholder="Selecione un Imgen *" accept="image/*"
                                        class="form-control @error('photo') is-invalid @enderror"
                                        wire:model="photo" />
                                @endif
                                @error('photo')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled"
                        wire:target="save, photo" wire:click="save">Crear</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Editar-->
    <div wire:ignore.self class="modal fade" id="update" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Editar Proveedor
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Nombres Producto *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-ui-file"> </i>
                                    </span>
                                    <input type="text" placeholder="Nombres Producto *"
                                        class="form-control @error('name') is-invalid @enderror" wire:model="name" />
                                </div>
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Selecione Una Categoria *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-cubes"> </i>
                                    </span>
                                    <select class="form-control" wire:model="selectcategory">
                                        <option value="">
                                            Selecione Una Categoria *
                                        </option>
                                        @foreach ($product_category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('selectcategory')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Stock Incial *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-memorial"> </i>
                                    </span>
                                    <div class="form-control">
                                        {{$stock}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Selecione Marca *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-book-mark"> </i>
                                    </span>
                                    <select wire:model="selectbrands"
                                        class="form-control @error('selectbrands') is-invalid @enderror">
                                        <option value="">{{ __('Selecione Marca') }} *</option>
                                        @foreach ($brands as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('selectbrands')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Codigo Producto *</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="cursor:pointer;" wire:click="codeg">
                                        <i class="icofont icofont-bar-code"> </i>
                                    </span>
                                    <input type="number" placeholder="Codigo Producto *"
                                        class="form-control @error('code') is-invalid @enderror" wire:model="code" />
                                </div>
                                @error('code')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Precio Compra*</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-price"> </i>
                                    </span>
                                    <input type="number" step="0.01" placeholder="Precio Compra *"
                                        class="form-control @error('price') is-invalid @enderror" wire:model="price" />
                                </div>
                                <label class="mt-2 text-danger">
                                    @if ($price != null)
                                        $ <?php echo number_format($price, 0, ',', '.'); ?> <br>
                                    @endif
                                </label>
                                @error('price')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">{{ __('Desactivar productos?') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-toggle-off"> </i>
                                    </span>
                                    <select wire:model="status"
                                        class="form-control @error('status') is-invalid @enderror">
                                        <option value="0">NO</option>
                                        <option value="1">SI</option>
                                    </select>
                                </div>
                                @error('status')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Precio Venta*</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-price"> </i>
                                    </span>
                                    <input type="number" step="0.01" placeholder="Precio Compra *"
                                        class="form-control @error('priceSale') is-invalid @enderror" wire:model="priceSale" />
                                </div>
                                <label class="mt-2 text-danger">
                                    @if ($priceSale != null)
                                        $ <?php echo number_format($priceSale, 0, ',', '.'); ?> <br>
                                    @endif
                                </label>
                                @error('priceSale')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Descripción *</label>
                                <textarea wire:model="description" rows="3" cols="20" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="{{ __('Descripción') }} *"></textarea>
                                @error('description')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Selecione un Imgen *</label>
                                @if ($photo)
                                    <br>
                                    <button type="button" class="btn-close" wire:click="cancelimg2"
                                        aria-label="Close"></button>

                                    <button wire:loading wire:target="photo" class="btn btn-primary" type="button"
                                        disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        <span class="visually-hidden">Loading...</span>
                                    </button>
                                    <div class="col-lg text-center">
                                        <img src="{{ $photo->temporaryUrl() }}" class="img-100 img-fluid"
                                            alt="Responsive image">
                                    </div>
                                @else
                                    <input type="file" placeholder="Selecione un Imgen *" accept="image/*"
                                        class="form-control @error('photo') is-invalid @enderror"
                                        wire:model="photo" />
                                @endif
                                @error('photo')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" updating="true"
                        wire:click="update">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script type="text/javascript">
            Livewire.on('remove', Id => {
                Swal.fire({
                    title: '¿Estas seguro de eliminar?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si lo borra!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('products-view', 'destroy', Id)

                        Swal.fire(
                            'Eliminar!',
                            'Su registro ha sido eliminado.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush

</div>
