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
                                    <input class="form-control" type="search" wire:model="search" placeholder="Buscar"
                                        aria-label="Search">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <div class="mb-3">
                                    <select class="form-select digits" wire:model="perPage">
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
                                        <th>Proveedor</th>
                                        <th>Codigo</th>
                                        <th>Precio</th>
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
                                                {{ $item->provider->name }}
                                            </td>
                                            <td>
                                                {{ $item->code }}
                                            </td>
                                            <td>
                                                {{ $item->price }}
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
                                                    @can('Proveedor - Eliminar')
                                                        <button type="button" class="btn btn-danger"
                                                            wire:click="$emit('remove', {{ $item->id }})"
                                                            data-bs-toggle="modal" data-bs-target="#permissionModal">
                                                            <i class="icofont icofont-ui-delete"></i>
                                                        </button>
                                                    @endcan
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
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <input type="text" placeholder="Nombres Producto *"
                                    class="form-control @error('name') is-invalid @enderror" wire:model="name" />
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Selecione Una Categoria *</label>
                                <select wire:model="selectcategory"
                                    class="form-control @error('selectcategory') is-invalid @enderror">
                                    <option value="">{{ __('Selecione Una Categoria') }} *</option>
                                    @foreach ($product_category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectcategory')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Codigo Producto *</label>
                                <input type="number" placeholder="Codigo Producto *"
                                    class="form-control @error('code') is-invalid @enderror" wire:model="code" />
                                @error('code')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Precio *</label>
                                <input type="number" step="0.01" placeholder="Precio *"
                                    class="form-control @error('price') is-invalid @enderror" wire:model="price" />
                                @error('price')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Descuento *</label>
                                <input type="number" placeholder="Codigo Producto *"
                                    class="form-control @error('sales') is-invalid @enderror" wire:model="sales" />
                                @error('sales')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Nuevo *</label>
                                <select wire:model="new" class="form-control @error('new') is-invalid @enderror">
                                    <option value="0">NO</option>
                                    <option value="1">SI</option>
                                </select>
                                @error('new')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">{{ __('Desactivar productos?') }} *</label>
                                <select wire:model="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="0">NO</option>
                                    <option value="1">SI</option>
                                </select>
                                @error('status')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">{{ __('Productos Slider?') }} *</label>
                                <select wire:model="slider" class="form-control @error('slider') is-invalid @enderror">
                                    <option value="0">NO</option>
                                    <option value="1">SI</option>
                                </select>
                                @error('slider')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        @if ($slider == 1)
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="Name">Selecione un Imgen Slaider* - Imagen 1815*710</label>
                                    @if ($photo2)
                                        <br>
                                        <button type="button" class="btn-close" wire:click="cancelimg"
                                            aria-label="Close"></button>

                                        <button wire:loading wire:target="photo2" class="btn btn-primary" type="button"
                                            disabled>
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            <span class="visually-hidden">Loading...</span>
                                        </button>
                                        <div class="col-lg text-center">
                                            <img src="{{ $photo2->temporaryUrl() }}" class="img-100 img-fluid"
                                                alt="Responsive image">
                                        </div>
                                    @else
                                        <input type="file" placeholder="Selecione un Imgen *" accept="image/*"
                                            class="form-control @error('photo2') is-invalid @enderror"
                                            wire:model="photo2" />
                                    @endif
                                    @error('photo2')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                        @endif

                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Selecione Proveedor *</label>
                                <select wire:model="selectprovider"
                                    class="form-control @error('selectprovider') is-invalid @enderror">
                                    <option value="">{{ __('Selecione Proveedor') }} *</option>
                                    @foreach ($providers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectprovider')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Nit</label>
                                <input type="text" class="form-control" value="{{ $providerNit }}" disabled>
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
                                <label for="Name">Descripción Larga *</label>
                                <textarea wire:model="descriptionLong" rows="3" cols="20"
                                    class="form-control @error('descriptionLong') is-invalid @enderror"
                                    placeholder="{{ __('Descripción Larga') }} *"></textarea>
                                @error('descriptionLong')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Especificaciones *</label>
                                <textarea wire:model="Specifications" rows="3" cols="20"
                                    class="form-control @error('Specifications') is-invalid @enderror"
                                    placeholder="{{ __('Especificaciones') }} *"></textarea>
                                @error('Specifications')
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
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <input type="text" placeholder="Nombres Producto *"
                                    class="form-control @error('name') is-invalid @enderror" wire:model="name" />
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Selecione Una Categoria *</label>
                                <select wire:model="selectcategory"
                                    class="form-control @error('selectcategory') is-invalid @enderror">
                                    <option value="">{{ __('Selecione Una Categoria') }} *</option>
                                    @foreach ($product_category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectcategory')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Codigo Producto *</label>
                                <input type="number" placeholder="Codigo Producto *"
                                    class="form-control @error('code') is-invalid @enderror" wire:model="code" />
                                @error('code')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Precio *</label>
                                <input type="number" step="0.01" placeholder="Precio *"
                                    class="form-control @error('price') is-invalid @enderror" wire:model="price" />
                                @error('price')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Descuento</label>
                                <input type="number" placeholder="Codigo Producto"
                                    class="form-control @error('sales') is-invalid @enderror" wire:model="sales" />
                                @error('sales')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Nuevo *</label>
                                <select wire:model="new" class="form-control @error('new') is-invalid @enderror">
                                    <option value="0">NO</option>
                                    <option value="1">SI</option>
                                </select>
                                @error('new')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">{{ __('Desactivar productos?') }} *</label>
                                <select wire:model="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                    <option value="0">NO</option>
                                    <option value="1">SI</option>
                                </select>
                                @error('status')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">{{ __('Productos Slider?') }} *</label>
                                <select wire:model="slider"
                                    class="form-control @error('slider') is-invalid @enderror">
                                    <option value="0">NO</option>
                                    <option value="1">SI</option>
                                </select>
                                @error('slider')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        @if ($slider == 1)
                            <div class="col-lg">
                                <label for="Name">Selecione un Imgen Slaider* - Imagen 1815*710</label>
                                @if ($Updatephotos2)
                                    <br>
                                    <button type="button" class="btn-close" wire:click="cancelimg2"
                                        aria-label="Close"></button>

                                    <button wire:loading wire:target="Updatephotos2" class="btn btn-primary"
                                        type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        <span class="visually-hidden">Loading...</span>
                                    </button>
                                    <div class="img-container"><img class="img-100 img-fluid"
                                            src="/storage/{{ $Updatephotos2 }}" alt="">
                                    </div>
                                @else
                                    @if ($photos2)
                                        <br>
                                        <button type="button" class="btn-close" wire:click="cancelimg2"
                                            aria-label="Close"></button>

                                        <button wire:loading wire:target="photos2" class="btn btn-primary" type="button"
                                            disabled>
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            <span class="visually-hidden">Loading...</span>
                                        </button>
                                        <div class="col-lg text-center">
                                            <img src="{{ $photos2->temporaryUrl() }}" class="img-100 img-fluid"
                                                alt="Responsive image">
                                        </div>
                                    @else
                                        <input type="file" id="{{ $idenImg }}" placeholder="Selecione un Imgen *"
                                            class="form-control @error('photos2') is-invalid @enderror"
                                            wire:model="photos2" accept="image/*" />
                                    @endif
                                @endif
                            </div>
                            <br>
                        @endif

                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Selecione Proveedor *</label>
                                <select wire:model="selectprovider"
                                    class="form-control @error('selectprovider') is-invalid @enderror">
                                    <option value="">{{ __('Selecione Proveedor') }} *</option>
                                    @foreach ($providers as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectprovider')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Nit</label>
                                <input type="text" class="form-control" value="{{ $providerNit }}" disabled>
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
                                <label for="Name">Descripción Larga *</label>
                                <textarea wire:model="descriptionLong" rows="3" cols="20"
                                    class="form-control @error('descriptionLong') is-invalid @enderror"
                                    placeholder="{{ __('Descripción Larga') }} *"></textarea>
                                @error('descriptionLong')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Especificaciones *</label>
                                <textarea wire:model="Specifications" rows="3" cols="20"
                                    class="form-control @error('Specifications') is-invalid @enderror"
                                    placeholder="{{ __('Especificaciones') }} *"></textarea>
                                @error('Specifications')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Selecione un Imgen *</label>
                                @if ($Updatephotos)
                                    <br>
                                    <button type="button" class="btn-close" wire:click="cancelimg"
                                        aria-label="Close"></button>

                                    <button wire:loading wire:target="Updatephotos" class="btn btn-primary"
                                        type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        <span class="visually-hidden">Loading...</span>
                                    </button>
                                    <div class="img-container"><img class="img-100 img-fluid"
                                            src="/storage/{{ $Updatephotos }}" alt="">
                                    </div>
                                @else
                                    @if ($photos)
                                        <br>
                                        <button type="button" class="btn-close" wire:click="cancelimg"
                                            aria-label="Close"></button>

                                        <button wire:loading wire:target="photos" class="btn btn-primary" type="button"
                                            disabled>
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            <span class="visually-hidden">Loading...</span>
                                        </button>
                                        <div class="col-lg text-center">
                                            <img src="{{ $photos->temporaryUrl() }}" class="img-100 img-fluid"
                                                alt="Responsive image">
                                        </div>
                                    @else
                                        <input type="file" id="{{ $idenImg }}" placeholder="Selecione un Imgen *"
                                            class="form-control @error('photos') is-invalid @enderror"
                                            wire:model="photos" accept="image/*" />
                                    @endif
                                @endif
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
