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
                                        <th scope="col">id</th>
                                        <th scope="col">nombre</th>
                                        <th scope="col">correo</th>
                                        <th scope="col">celular</th>
                                        <th scope="col">N Documento</th>
                                        <th scope="col">Ficha</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $item)
                                <tr>
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>
                                        {{ $item->cel }}
                                    </td>
                                    <td>
                                        {{ $item->ndocumento }}
                                    </td>
                                    <td>
                                        {{ $item->code }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success"
                                                wire:click="view({{ $item->id }})" wire:target="view"
                                                data-toggle="modal" data-target="#view">
                                                <i class="icofont icofont-eye-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-info mr-2 ml-2"
                                                wire:click="edit({{ $item->id }})" wire:target="edit"
                                                data-toggle="modal" data-target="#update">
                                                <i class="icofont icofont-ui-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                wire:click="$emit('remove', {{ $item->id }})">
                                                <i class="icofont icofont-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $apprentices->links() }} --}}
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Primer Nombre *</label>
                                <input type="text" placeholder="Primer Nombre" class="form-control"
                                    wire:model="name" />
                                @error('first_surname') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Segundo Nombre *</label>
                                <input type="text" class="form-control" autocomplete="off"
                                    placeholder="Segundo Nombre" wire:model="text" />
                                @error('last_surname') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Primer Nombre *</label>
                                <input type="text" placeholder="Primer Nombre" class="form-control"
                                    wire:model="name" />
                                @error('first_surname') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Segundo Nombre *</label>
                                <input type="text" class="form-control" autocomplete="off"
                                    placeholder="Segundo Nombre" wire:model="last_surname" />
                                @error('last_surname') <span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Telefono *</label>
                                <input type="text" placeholder="Telefono" class="form-control" wire:model="phone" />
                                @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Correo Electonico *</label>
                                <input type="email" class="form-control" autocomplete="off" placeholder="email"
                                    wire:model="email" />
                                @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="Name">Direccion *</label>
                                <input type="text" placeholder="Direccion" class="form-control" wire:model="name" />
                                @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="Name">Ciudad *</label>
                                <input type="text" class="form-control" autocomplete="off" placeholder="Ciudad"
                                    wire:model="city" />
                                @error('city') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
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
    @endpush
</div>
