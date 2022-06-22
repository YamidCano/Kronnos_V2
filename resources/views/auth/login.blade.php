@extends('layouts.auth')

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <a class="logo" href="index.html">
                                <img class="img-fluid for-light" src="../assets/images/logo/login.png" alt="looginpage">
                                <img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="looginpage">
                            </a>
                        </div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <h4>Iniciar sesión en la cuenta</h4>
                                <p>Ingrese su correo electrónico y contraseña para iniciar sesión</p>
                                <div class="form-group">
                                    <input type="hidden" name="csrf-token" value="{!! csrf_token() !!}">
                                    <label class="col-form-label">Dirección de correo electrónico</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" required autocomplete="off" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Contraseñas</label>
                                    <div class="form-input position-relative">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Recuérdame') }}
                                            </label>
                                        </div>
                                    </div>
                                    {{-- @if (Route::has('password.request'))
                                        <a class="link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                    <div class="text-end mt-3">
                                        <button type="submit" class="btn btn-primary btn-block w-100">
                                            {{ __('Ingresar') }}
                                        </button>
                                    </div>
                                </div>

                                {{-- <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2"
                                        href="sign-up.html">Create Account</a></p> --}}
                            </form>
                            <div>
                                <div class="h6 mt-4">
                                    <strong>Administrador</strong>
                                </div>
                                <button type="button" onclick="Administrador()" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Haga clic aquí para copiar las credenciales de admin"
                                    class="btn btn-outline-secundary btn-icon float-end">
                                    <i class="icofont icofont-ui-copy text-danger" style="font-size: 20px;">
                                    </i>
                                </button>
                                <div class="">Email: <strong>admin@kronnos.com</strong></div>
                                <div class="">Contraseña: <strong>VUyOvScy</strong></div>
                            </div>
                            <div>
                                <div class="h6 mt-4">
                                    <strong>Vendedor</strong>
                                </div>
                                <button type="button" onclick="vendedor()" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Haga clic aquí para copiar las credenciales de vendedor"
                                    class="btn btn-outline-secundary btn-icon float-end">
                                    <i class="icofont icofont-ui-copy text-danger" style="font-size: 20px;">
                                    </i>
                                </button>
                                <div class="">Email: <strong>vendedor@kronnos.com</strong></div>
                                <div class="">Contraseña: <strong>VUyOvScy</strong></div>
                            </div>
                            <div>
                                <div class="h6 mt-4">
                                    <strong>Usuario</strong>
                                </div>
                                <button type="button" onclick="usuario()" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Haga clic aquí para copiar las credenciales de usuario"
                                    class="btn btn-outline-secundary btn-icon float-end">
                                    <i class="icofont icofont-ui-copy text-danger" style="font-size: 20px;">
                                    </i>
                                </button>
                                <div class="">Email: <strong>usuario@kronnos.com</strong></div>
                                <div class="">Contraseña: <strong>VUyOvScy</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function Administrador() {
            let email = document.getElementById("email");
            email.value = "admin@kronnos.com";
            let password = document.getElementById("password");
            password.value = "VUyOvScy";
        }

        function vendedor() {
            let email = document.getElementById("email");
            email.value = "vendedor@kronnos.com";
            let password = document.getElementById("password");
            password.value = "VUyOvScy";
        }

        function usuario() {
            let email = document.getElementById("email");
            email.value = "usuario@kronnos.com";
            let password = document.getElementById("password");
            password.value = "VUyOvScy";
        }
    </script>
@endsection
