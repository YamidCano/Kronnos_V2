<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Usuarios</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Usuarios</li>
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
                                @can('Usuario - Crear')
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                            data-bs-target="#Store">
                                            Crear Usuario
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
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }} {{ $item->last_name }}
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
                                                <div class="">
                                                    @if (Auth::user()->id == $item->id)
                                                        <a type="button" class="btn btn-info"
                                                            href="{{ url('perfil') }}">
                                                            <i class="icofont icofont-open-eye"></i>
                                                        </a>
                                                    @else
                                                        @can('Usuario - Editar')
                                                            <button type="button" class="btn btn-info"
                                                                wire:click="edit({{ $item->id }})" wire:target="edit"
                                                                data-bs-toggle="modal" data-bs-target="#update">
                                                                <i class="icofont icofont-ui-edit"></i>
                                                            </button>
                                                        @endcan
                                                        @can('Usuario - Desativar')
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
                                                    @endif
                                                    @can('Usuario - Permisos')
                                                        <button type="button" class="btn btn-success"
                                                            wire:click="$emit('addPermission', {{ $item->id }})"
                                                            data-bs-toggle="modal" data-bs-target="#permissionModal">
                                                            <i class="icofont icofont-paper"></i>
                                                        </button>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            {{ $users->links() }}
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
                        Crear Usuario
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
                                <label for="Name">Apellidos *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-user-alt-5"> </i>
                                    </span>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        autocomplete="off" placeholder="Apellidos" wire:model="last_name" />
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
                                <label for="Name">Selecione Rol *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-ui-user-group"> </i>
                                    </span>
                                    <select wire:model="selecRole"
                                        class="form-control @error('selecRole') is-invalid @enderror">
                                        <option value="">{{ __('Selecione Rol') }} *</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selecRole')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

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
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Cliente?</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-toggle-off"> </i>
                                    </span>
                                    <select wire:model="cliente"
                                        class="form-control @error('cliente') is-invalid @enderror">
                                        <option value="0">NO</option>
                                        <option value="1">SI</option>
                                    </select>
                                </div>
                                @error('cliente')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Contrase??a *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-ui-password"> </i>
                                    </span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        wire:model="password" placeholder="{{ __('Contrase??a') }}">
                                    @error('password')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                @if (empty($password))
                                @else
                                    <label for="Name">Confirmar Contrase??a *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-ui-password"> </i>
                                        </span>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            wire:model="password_confirmation"
                                            placeholder="{{ __('Confirmar Contrase??a *') }}">
                                        @error('password')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @error('password_confirmation')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                @endif
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
                        Editar Usuario
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
                                <label for="Name">Apellidos *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-user-alt-5"> </i>
                                    </span>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        autocomplete="off" placeholder="Apellidos" wire:model="last_name" />
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
                                <label for="Name">Selecione Rol *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-ui-user-group"> </i>
                                    </span>
                                    <select wire:model="selecRole"
                                        class="form-control @error('selecRole') is-invalid @enderror">
                                        <option value="">{{ __('Selecione Rol') }} *</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selecRole')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>

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
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Cliente?</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-toggle-off"> </i>
                                    </span>
                                    <select wire:model="cliente"
                                        class="form-control @error('cliente') is-invalid @enderror">
                                        <option value="0">NO</option>
                                        <option value="1">SI</option>
                                    </select>
                                </div>
                                @error('cliente')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Contrase??a *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-ui-password"> </i>
                                    </span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        wire:model="password" placeholder="{{ __('Contrase??a') }}">
                                    @error('password')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                @if (empty($password))
                                @else
                                    <label for="Name">Confirmar Contrase??a *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-ui-password"> </i>
                                        </span>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            wire:model="password_confirmation"
                                            placeholder="{{ __('Confirmar Contrase??a *') }}">
                                        @error('password')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    @error('password_confirmation')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                @endif
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

    <!-- Modal Permission -->
    <div wire:ignore.self class="modal fade" id="permissionModal" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ __('Permisos') }}
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <div wire:loading wire:target="addPermissionKey"
                        class="spinner-border spinner-border-sm text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="container">
                            <div class="table-responsive" id="caja">
                                <table class="table card-table table-vcenter text-nowrap">
                                    <tbody>
                                        @foreach ($permission_check as $key => $p)
                                            <tr>
                                                <td class="btn-group">
                                                    <div>
                                                        @if ($p['check'])
                                                            <span class="mr-2 ml-1 text-primary fa fa-check"></span>
                                                        @else
                                                            <span class="mr-3 ml-1 text-danger fa fa-times"></span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <label class="form-check-label h6" for="{{ $key }}">
                                                            {{ $key }}
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="{{ $key }}"
                                                                wire:model="permission_check.{{ $key }}.check"
                                                                wire:click="addPermissionKey('{{ $key }}')"
                                                                wire:loading.attr="disabled"
                                                                class="dasabled:opacity-25">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            Livewire.on('ActivateUser', itemId => {
                Swal.fire({
                    title: '??Est?? seguro de activar el usuario?',
                    text: "??El usuario podr?? ingresar al sistema!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('user.user-view', 'statusActivate', itemId)

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
                    title: '??Est?? seguro de desactivar el usuario?',
                    text: "??El usuario ya no podr?? ingresar al sistema!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('user.user-view', 'statusDeactivate', itemId)

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
