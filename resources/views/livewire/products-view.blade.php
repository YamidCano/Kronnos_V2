<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Productos</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i data-feather="home"></i></a></li>
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
                                        <th>Nombres Proveedor</th>
                                        <th>Telefono</th>
                                        <th>Nit</th>
                                        <th>En Uso (Productos)</th>
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
                                                {{ $item->phone }}
                                            </td>
                                            <td>
                                                {{ $item->nit }}
                                            </td>
                                            <td>
                                                <img class="img-fluid img-40" src="/storage/{{ $item->photo }}">
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
                                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                @error('selectcategory') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
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
                                @error('selectprovider') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Nit</label>
                                <input type="text" class="form-control" value="{{ $providerNit }}" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Descripcion *</label>
                                <textarea wire:model="description" rows="3" cols="20" class="form-control"
                                    placeholder="{{ __('Descripcion') }} *"></textarea>
                                @error('description') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Selecione un Imgen *</label>
                                @if ($photo)
                                    <br>
                                    <button type="button" class="btn-close" wire:click="cancelimg"
                                        aria-label="Close"></button>

                                    <button wire:loading wire:target="photo" class="btn btn-primary" type="button"
                                        disabled>
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        <span class="visually-hidden">Loading...</span>
                                    </button>
                                    <div class="img-container"><img class="img-thumbnail"
                                            src="{{ $photo->temporaryUrl() }}" alt=""></div>
                                @else
                                    <input type="file" id="{{ $idenImg }}" placeholder="Selecione un Imgen *"
                                        class="form-control @error('photo') is-invalid @enderror" wire:model="photo" />
                                @endif
                                @error('photo') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save, photo"
                        wire:click="save">Crear</button>
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
                                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                @error('selectcategory') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
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
                                @error('selectprovider') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Nit</label>
                                <input type="text" class="form-control" value="{{ $providerNit }}" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Descripcion *</label>
                                <textarea wire:model="description" rows="3" cols="20" class="form-control"
                                    placeholder="{{ __('Descripcion') }} *"></textarea>
                                @error('description') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
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
                                    <div class="img-container"><img class="img-thumbnail"
                                            src="/storage/{{ $Updatephotos }}" alt=""></div>
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
                                        <div class="img-container"><img class="img-thumbnail"
                                                src="{{ $photos->temporaryUrl() }}" alt=""></div>
                                    @else
                                        <input type="file" id="{{ $idenImg }}" placeholder="Selecione un Imgen *"
                                            class="form-control @error('photos') is-invalid @enderror"
                                            wire:model="photos" />
                                    @endif
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="update">Actualizar</button>
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

                        Livewire.emitTo('providers-view', 'destroy', Id)

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
