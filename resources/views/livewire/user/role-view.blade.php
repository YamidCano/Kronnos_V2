<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Roles y Permisos</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Roles y Permisos</li>
                        {{-- <li class="breadcrumb-item active">Sample Page</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <div class="container-fluid">
                    <div class="card">
                        @can('Role y Permisos - Crear')
                            <div class="m-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#Store">
                                    {{ trans('lang.Create Role') }}
                                </button>
                            </div>
                        @endcan
                        <h4 class="m-2">Roles</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ trans('lang.Name') }}</th>
                                        <th scope="col">{{ trans('lang.In Use') }}</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $item)
                                        <tr>
                                            <td scope="row">
                                                {{ $item->name }}
                                            </td>
                                            <td scope="row">
                                                @if ($item->count_user > 0)
                                                    <span class="float badge badge-success">
                                                        {{ $item->count_user }}
                                                    </span>
                                                @else
                                                    <span class="float badge badge-danger">
                                                        {{ $item->count_user }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    @can('Role y Permisos - Editar')
                                                        <button type="button" class="btn btn-info"
                                                            wire:click="edit({{ $item->id }})" wire:target="edit"
                                                            data-bs-toggle="modal" data-bs-target="#update">
                                                            <i class="icofont icofont-ui-edit"></i>
                                                        </button>
                                                    @endcan
                                                    @can('Role y Permisos - Permisos')
                                                        <button type="button" class="btn btn-success"
                                                            wire:click="$emit('addPermission', {{ $item->id }})"
                                                            data-bs-toggle="modal" data-bs-target="#permissionModal">
                                                            <i class="icofont icofont-paper"></i>
                                                        </button>
                                                    @endcan
                                                    @can('Role y Permisos - Eliminar')
                                                        @if (!$item->count_user)
                                                            <button type="button" class="btn btn-danger"
                                                                wire:click="$emit('removeRole', {{ $item->id }})">
                                                                <i class="icofont icofont-ui-delete"></i>
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="container-fluid">
                    <div class="card">
                        <h4 class="m-2">{{ trans('lang.Permission') }}</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ trans('lang.Name') }}</th>
                                        <th scope="col">{{ trans('lang.In Use') }}</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $item)
                                        <tr>
                                            <td scope="row">
                                                {{ $item->name }}
                                            </td>
                                            <td scope="row">
                                                @if ($item->count_user > 0)
                                                    <span class="float badge badge-success">
                                                        {{ $item->count_user }}
                                                    </span>
                                                @else
                                                    <span class="float badge badge-danger">
                                                        {{ $item->count_user }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    @can('Role y Permisos - Eliminar')
                                                        @if (!$item->count_user)
                                                            <button type="button" class="btn btn-danger"
                                                                wire:click="$emit('removePermission', {{ $item->id }})">
                                                                <i class="icofont icofont-ui-delete"></i>
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ trans('lang.Create Role') }}
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label><strong>{{ trans('lang.Role') }}</strong></label>
                            <input type="text" wire:model="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ trans('lang.Role') }}">
                            @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">{{ trans('lang.Close') }}</button>
                    <button type="button" class="btn btn-primary" wire:click="save">{{ trans('lang.Save') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal update -->
    <div wire:ignore.self class="modal fade" id="update" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ trans('lang.Edit Role') }}
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label><strong>{{ trans('lang.Role') }}</strong></label>
                            <input type="text" wire:model="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ trans('lang.Role') }}">
                            @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">{{ trans('lang.Close') }} </button>
                    <button type="button" class="btn btn-success" wire:click="update" wire:loading.attr="disabled"
                        wire:target="update" class="dasabled:opacity-25">
                        {{ trans('lang.Update') }} <span wire:loading
                            wire:target="update">{{ __('...') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Permission -->
    <div wire:ignore.self class="modal fade" id="permissionModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ trans('lang.Permission') }}
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
                        data-bs-dismiss="modal">{{ trans('lang.Close') }}</button>

                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            Livewire.on('removeRole', itemId => {
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

                        Livewire.emitTo('user.role-view', 'deleteRole', itemId)

                        Swal.fire(
                            'Eliminar!',
                            'Su Rol ha sido eliminado.',
                            'success'
                        )
                    }
                })
            });
            Livewire.on('removePermission', itemId => {
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

                        Livewire.emitTo('user.role-view', 'deletePermission', itemId)

                        Swal.fire(
                            'Eliminar!',
                            'Su Permiso ha sido eliminado.',
                            'success'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
