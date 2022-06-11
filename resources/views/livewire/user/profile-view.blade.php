<div>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Editar Perfil</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
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
                        <form>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="Name">Nombres *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-user-alt-5"> </i>
                                        </span>
                                        <input type="text" placeholder="Nombres"
                                            class="form-control @error('name') is-invalid @enderror"
                                            wire:model="name" />
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
                                    {{-- <label for="Name">Selecione Rol *</label>
                                        <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-ui-user-group"> </i>
                                        </span>
                                        <select  wire:model="selecRole" class="form-control @error('selecRole') is-invalid @enderror">
                                    </div>

                                        <option value="">{{ __('Selecione Rol') }} *</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selecRole') <span
                                    class="text-danger error">{{ $message }}</span>@enderror --}}
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
                                            class="form-control @error('phone') is-invalid @enderror"
                                            wire:model="phone" />
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
                                    <label for="Name">Contraseña *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-ui-password"> </i>
                                        </span>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            wire:model="password" placeholder="{{ __('Password') }}">
                                    </div>

                                    @error('password')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    @if (empty($password))
                                    @else
                                        <label for="Name">Contraseña *</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="icofont icofont-ui-password"> </i>
                                            </span>
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                wire:model="password_confirmation"
                                                placeholder="{{ __('Confirm Password') }}">
                                        </div>


                                        @error('password_confirmation')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
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
