<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Modo de Pago</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Modo de Pago</li>
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
                                @can('Taxes - Crear')
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                            data-bs-target="#Store">
                                            Crear Modo de Pago
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
                            <table class="table table-striped table-hover card-table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Modo de Pago</th>
                                        <th>En Uso</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentModes as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->count_paymentOut }}
                                            </td>
                                            <td>
                                                <div class="">
                                                    @can('Taxes - Editar')
                                                        <button type="button" class="btn btn-info"
                                                            wire:click="edit({{ $item->id }})" wire:target="edit"
                                                            data-bs-toggle="modal" data-bs-target="#update">
                                                            <i class="icofont icofont-ui-edit"></i>
                                                        </button>
                                                    @endcan
                                                    @if ($item->count_paymentOut == 0)
                                                        @can('Taxes - Eliminar')
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
                            {{ $paymentModes->links() }}
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
        <div class="modal-dialog modal modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Crear Modo de Pago
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Modo de Pago *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-credit-card"> </i>
                                    </span>
                                    <input type="text" placeholder="Modo de Pago *"
                                        class="form-control @error('name') is-invalid @enderror" wire:model="name" />
                                </div>
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="close"
                        data-bs-dismiss="modal">Cerrar</button>
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
                        Editar Modo de Pago
                    </h5>
                    <button type="button" class="btn-close" wire:click="close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Modo de Pago *</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="icofont icofont-credit-card"> </i>
                                    </span>
                                    <input type="text" placeholder="Modo de Pago *"
                                        class="form-control @error('name') is-invalid @enderror" wire:model="name" />
                                </div>
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
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
                    title: '??Estas seguro de eliminar?',
                    text: "??No podr??s revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si lo borra!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('payment-mode-view', 'destroy', Id)

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
