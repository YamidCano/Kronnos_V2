<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Usuarios</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Usuarios</li>
                        {{-- <li class="breadcrumb-item active">Sample Page</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="d-flex bd-highlight m-3">
                        <div class="p-2 bd-highlight">
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#Store">
                                Crear Usuario
                            </button>
                        </div>
                        <div class="ml-auto p-2 bd-highlight">
                            <input class="form-control mr-sm-2  mb-2" type="search" wire:model="search"
                                placeholder="Buscar por nombre" aria-label="Search">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover card-table table-vcenter text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>identification</th>
                                        <th>Correo</th>
                                        <th>Telefono</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>
                                                {{ $item->first_name }} {{ $item->last_name }}
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
                                            </td>
                                            <td>
                                                {{ $item->city }}
                                            </td>
                                            <td>
                                                <div class="">
                                                    @if (Auth::user()->id == $item->id)
                                                        <a type="button" class="btn btn-info" href="{{ url('perfil') }}">
                                                            <i class="icofont icofont-open-eye"></i>
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn btn-info"
                                                            wire:click="edit({{ $item->id }})" wire:target="edit"
                                                            data-bs-toggle="modal" data-bs-target="#update">
                                                            <i class="icofont icofont-ui-edit"></i>
                                                        </button>
                                                        @if ($item->status == 1)
                                                            <button type="button" class="btn btn-success"
                                                                wire:click="$emit('ActivateUser', {{ $item->id }})"
                                                                wire:target="ActivateUser">
                                                                <i class="icofont icofont-ui-check"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-danger"
                                                                wire:click="$emit('DeactivateUser', {{ $item->id }})"
                                                                wire:target="DeactivateUser">
                                                                <i class="icofont icofont-ui-close"></i>
                                                            </button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $apprentices->links() }}
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
                                <input type="text" placeholder="Nombres"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    wire:model="first_name" />
                                @error('first_name') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Apellidos *</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    autocomplete="off" placeholder="Apellidos" wire:model="last_name" />
                                @error('last_name') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Identificacion *</label>
                                <input type="number" placeholder="Identificacion"
                                    class="form-control @error('identification') is-invalid @enderror"
                                    wire:model="identification" />
                                @error('identification') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Telefono *</label>
                                <input type="number" placeholder="Telefono"
                                    class="form-control @error('phone') is-invalid @enderror" wire:model="phone" />
                                @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Correo Electonico *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    autocomplete="off" placeholder="email" wire:model="email" />
                                @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Direccion *</label>
                                <input type="text" placeholder="Direccion"
                                    class="form-control @error('address') is-invalid @enderror" wire:model="address" />
                                @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Ciudad *</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    autocomplete="off" placeholder="Ciudad" wire:model="city" />
                                @error('city') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Contraseña *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    wire:model="password" placeholder="{{ __('Password') }}">
                                @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                @if (empty($password))
                                @else
                                    <label for="Name">Contraseña *</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        wire:model="password_confirmation"
                                        placeholder="{{ __('Confirm Password') }}">

                                    @error('password_confirmation') <span
                                        class="text-danger error">{{ $message }}</span>@enderror
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
                                <input type="text" placeholder="Nombres"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    wire:model="first_name" />
                                @error('first_name') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Apellidos *</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    autocomplete="off" placeholder="Apellidos" wire:model="last_name" />
                                @error('last_name') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Identificacion *</label>
                                <input type="number" placeholder="Identificacion"
                                    class="form-control @error('identification') is-invalid @enderror"
                                    wire:model="identification" />
                                @error('identification') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Telefono *</label>
                                <input type="number" placeholder="Telefono"
                                    class="form-control @error('phone') is-invalid @enderror" wire:model="phone" />
                                @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Correo Electonico *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    autocomplete="off" placeholder="email" wire:model="email" />
                                @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Direccion *</label>
                                <input type="text" placeholder="Direccion"
                                    class="form-control @error('address') is-invalid @enderror" wire:model="address" />
                                @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Ciudad *</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    autocomplete="off" placeholder="Ciudad" wire:model="city" />
                                @error('city') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Contraseña *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    wire:model="password" placeholder="{{ __('Password') }}">
                                @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                @if (empty($password))
                                @else
                                    <label for="Name">Contraseña *</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        wire:model="password_confirmation"
                                        placeholder="{{ __('Confirm Password') }}">

                                    @error('password_confirmation') <span
                                        class="text-danger error">{{ $message }}</span>@enderror
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

    @push('js')
        <script type="text/javascript">
            Livewire.on('remove', ID => {
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
                        Livewire.emitTo('apprentice', 'destroyApprentices', ID)
                        Swal.fire(
                            'Eliminar!',
                            'Su registro ha sido eliminado.',
                            'success'
                        )
                    }
                })
            });
        </script>
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

                        Livewire.emitTo('user.user-view', 'statusActivate', itemId)

                        Swal.fire(
                            'Activado!',
                            'Usuario Activado correctamente.',
                            'success'
                        )
                    }
                })
            });
        </script>
        <script>
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
