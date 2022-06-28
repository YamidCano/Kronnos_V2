<div>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <a class="logo" href="{{ url('register') }}">
                                <img class="img-fluid for-light" src="../assets/images/logo/login.png" alt="looginpage">
                                <img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png"
                                    alt="looginpage">
                            </a>
                        </div>
                        <div>
                            @if ($this->form)
                                <form>
                                    <h4>Crea tu cuenta</h4>
                                    <p>Si los datos no son los correctos, los puede actualizar desde tu perfil luego de
                                        haber registrado</p>
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <label for="Name">Nombres</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="icofont icofont-user-alt-5"> </i>
                                                </span>
                                                <div class="form-control">
                                                    {{ $name }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="Name">Apellidos</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="icofont icofont-user-alt-5"> </i>
                                                </span>
                                                <div class="form-control">
                                                    {{ $last_name }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <label for="Name">Numero de identificacion</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="icofont icofont-user-alt-5"> </i>
                                                </span>
                                                <div class="form-control">
                                                    {{ $identification }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <label for="Name">Correo electrónico</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="icofont icofont-user-alt-5"> </i>
                                                </span>
                                                <div class="form-control">
                                                    {{ $email }}
                                                </div>
                                            </div>
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
                                                    wire:model="password" placeholder="{{ __('Contraseña') }}">
                                            </div>
                                            @error('password')
                                                <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            @if (empty($password))
                                            @else
                                                <label for="Name">Confirmar Contraseña *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="icofont icofont-ui-password"> </i>
                                                    </span>
                                                    <input type="password"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        wire:model="password_confirmation"
                                                        placeholder="{{ __('Confirmar Contraseña *') }}">
                                                </div>
                                                @error('password_confirmation')
                                                    <span class="text-danger error">{{ $message }}</span>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="text-end mt-3">
                                            <button type="button" class="btn btn-primary"
                                                wire:click="save">Crear Contraseña</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div>
                                    <h4>Vamos a validar tu informacion</h4>
                                    <p>Ingrese tu numero de identificacion</p>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">
                                            <i class="icofont icofont-search"> </i>
                                        </span>
                                        <input class="form-control" type="number" wire:model="search"
                                            placeholder="Buscar" aria-label="Search">
                                        @if ($search != null)
                                            <span class="input-group-text" style="cursor:pointer;" wire:click="clean">
                                                <i class="icofont icofont-close-circled"> </i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-end mt-3">
                                        <button type="submit" wire:click="search"
                                            class="btn btn-primary btn-block w-100">
                                            Buscar
                                        </button>
                                    </div>
                                    <p class="mt-4 mb-0 text-center">Ya tienes una cuenta?
                                        <a class="ms-2" href="{{ url('login') }}">Ir al login</a>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
