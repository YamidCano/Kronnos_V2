<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Editar Perfil</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Editar Perfil</li>
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
                        <div class="card-body">
                            <form wire:ignore.self>
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
                                        @error('last_name') <span
                                            class="text-danger error">{{ $message }}</span>@enderror
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
                                            class="form-control @error('phone') is-invalid @enderror"
                                            wire:model="phone" />
                                        @error('phone') <span
                                            class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <label for="Name">Correo Electonico *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            autocomplete="off" placeholder="email" wire:model="email" />
                                        @error('email') <span
                                            class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row row-sm">
                                    <div class="col-lg">
                                        <label for="Name">Direccion *</label>
                                        <input type="text" placeholder="Direccion"
                                            class="form-control @error('address') is-invalid @enderror"
                                            wire:model="address" />
                                        @error('address') <span
                                            class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <label for="Name">Ciudad *</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                            autocomplete="off" placeholder="Ciudad" wire:model="city" />
                                        @error('city') <span
                                            class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <br>
                                <div class="row row-sm">
                                    <div class="col-lg">
                                        <label for="Name">Contraseña *</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            wire:model="password" placeholder="{{ __('Password') }}">
                                        @error('password') <span
                                            class="text-danger error">{{ $message }}</span>@enderror
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
                        <div class="card-footer text-end">
                            <a type="button" class="btn btn-danger" href="{{ url('home') }}">Close</a>
                            <button type="button" class="btn btn-info" wire:click="update">Actualizar</button>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->

</div>
