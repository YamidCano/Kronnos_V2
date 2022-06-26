<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Clientes</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Clientes</li>
                        {{-- <li class="breadcrumb-item active">Sample Page</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- {!! Avatar::create(Auth::user()->name)->setFontSize(20)->setDimension(40)->toSvg(); !!} --}}
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                @can('clients - Crear')
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                            data-bs-target="#Store">
                                            Crear Cliente
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
                                        <th>Nombres</th>
                                        <th>identification</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>Direccio</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->identification }}
                                            </td>
                                            <td>
                                                {{ $item->email }}
                                            </td>
                                            <td>
                                                {{ $item->phone }}
                                            </td>
                                            <td>
                                                {{ $item->address }}
                                                <br>
                                                {{ $item->city }}
                                            </td>
                                            <th>
                                                @if ($item->status == 0)
                                                    <div class="text-success">
                                                        Activo
                                                    </div>
                                                @else
                                                    <div class="text-danger">
                                                        Desactivado
                                                    </div>
                                                @endif

                                            </th>
                                            <td>
                                                @can('clients - Editar')
                                                    <button type="button" class="btn btn-info"
                                                        wire:click="edit({{ $item->id }})" wire:target="edit"
                                                        data-bs-toggle="modal" data-bs-target="#update">
                                                        <i class="icofont icofont-ui-edit"></i>
                                                    </button>
                                                @endcan
                                                @can('clients - Desativar')
                                                    @if ($item->status == 1)
                                                        <button type="button" class="btn btn-success"
                                                            wire:click="$emit('ActivateUser', {{ $item->id }})"
                                                            wire:target="ActivateUser">
                                                            <i class="icofont icofont-ui-unlock"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-danger"
                                                            wire:click="$emit('DeactivateUser', {{ $item->id }})"
                                                            wire:target="DeactivateUser">
                                                            <i class="icofont icofont-ui-lock"></i>
                                                        </button>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            {{ $clients->links() }}
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
                        Crear Cliente
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
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
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="save">Crear</button>
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
                        Editar Cliente
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
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
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="update">Actualizar</button>
                </div>
            </div>
        </div>
    </div>


    @push('js')
        <script>
            Livewire.on('ActivateUser', itemId => {
                Swal.fire({
                    title: '¿Está seguro de activar el usuario?',
                    text: "¡El usuario podrá ingresar al sistema!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('clients-view', 'statusActivate', itemId)

                        Swal.fire(
                            'Activado!',
                            'Usuario Activado correctamente.',
                            'success'
                        )
                    }
                })
            });

            Livewire.on('DeactivateUser', itemId => {
                Swal.fire({
                    title: '¿Está seguro de desactivar el usuario?',
                    text: "¡El usuario ya no podrá ingresar al sistema!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('clients-view', 'statusDeactivate', itemId)

                        Swal.fire(
                            'Desactivado!',
                            'Usuario Desactivado correctamente.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
