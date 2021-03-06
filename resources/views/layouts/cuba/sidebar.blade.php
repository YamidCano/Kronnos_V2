<div @if (auth()->user()->sidebar == 1) class="sidebar-wrapper close_icon"
    @else class="sidebar-wrapper" @endif>
    <div>
        <div class="logo-wrapper">
            <img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt="">
            <img class="img-fluid for-dark" src="../assets/images/logo/logo.png" alt="">
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            @livewire('components.sidebar')
        </div>
        <div class="logo-icon-wrapper"><a href="{{ url('home') }}"><img class="img-fluid"
                    src="../assets/images/logo/logo-icon.png" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="{{ url('home') }}"><img class="img-fluid"
                                src="../assets/images/logo/logo-icon.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div class="text-center">
                            <img class="img-70 rounded-circle" alt=""
                                src="https://ui-avatars.com/api/?name={{ Auth::user()->name }} {{ Auth::user()->last_name }}.'&color=FFFFFF&background=e74c3c">
                            <div>
                                <h5 class="mb-1 text-danger">{{ Auth::user()->name }}</h5>
                                <p>{{ Auth::user()->last_name }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        {{-- <label class="badge badge-success">2</label> --}}
                        <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                            href="{{ url('home') }}">
                            <i data-feather="home"></i><span class="lan-6">Dashboard </span></a>
                    </li>
                    @if (canView('Usuario - Tabla') or canView('Role y Permisos - Tabla'))
                        <li class="sidebar-list">
                            <a class="sidebar-link sidebar-title @if (Route::currentRouteName() == 'usuarios' or Route::currentRouteName() == 'rolesPermisos') active @endif"
                                href="#"><i data-feather="user"></i><span class="lan-6">Usuarios</span>
                                <div class="according-menu"><i
                                        class="@if (Route::currentRouteName() == 'usuarios' or Route::currentRouteName() == 'rolesPermisos') fa fa-angle-down @else  fa fa-angle-right @endif"></i>
                                </div>
                            </a>
                            <ul class="sidebar-submenu"
                                style="@if (Route::currentRouteName() == 'usuarios' or Route::currentRouteName() == 'rolesPermisos') display: block; @else  display: none; @endif">
                                @if (canView('Usuario - Tabla'))
                                    <li>
                                        <a href="{{ url('usuarios') }}"
                                            class="{{ Route::currentRouteName() == 'usuarios' ? 'active' : '' }}">
                                            Listado de Usuarios
                                        </a>
                                    </li>
                                @endif
                                @if (canView('Role y Permisos - Tabla'))
                                    <li>
                                        <a href="{{ url('rolesPermisos') }}"
                                            class="{{ Route::currentRouteName() == 'rolesPermisos' ? 'active' : '' }}">
                                            Roles y Permisos
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (canView('clients - Tabla'))
                        <li class="sidebar-list">
                            {{-- <label class="badge badge-success">2</label> --}}
                            <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'clients' ? 'active' : '' }}"
                                href="{{ url('clients') }}">
                                <i data-feather="users"></i><span class="lan-6">Clientes</span></a>
                        </li>
                    @endif
                    @if (canView('Proveedor - Tabla'))
                        <li class="sidebar-list">
                            {{-- <label class="badge badge-success">2</label> --}}
                            <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'proveedores' ? 'active' : '' }}"
                                href="{{ url('proveedores') }}">
                                <i data-feather="truck"></i><span class="lan-6">Proveedores</span></a>
                        </li>
                    @endif
                    @if (canView('Producto - Tabla') or canView('Brands - Tabla') or canView('Categoria-Producto - Tabla'))
                        <li class="sidebar-list"><a
                                class="sidebar-link sidebar-title @if (Route::currentRouteName() == 'ProductoCategoria' or Route::currentRouteName() == 'marcas' or Route::currentRouteName() == 'productos') active @endif"
                                href="#"><i data-feather="package"></i><span class="lan-6">Productos</span>
                                <div class="according-menu"><i
                                        class="@if (Route::currentRouteName() == 'ProductoCategoria' or Route::currentRouteName() == 'marcas' or Route::currentRouteName() == 'productos') fa fa-angle-down @else  fa fa-angle-right @endif"></i>
                                </div>
                            </a>
                            <ul class="sidebar-submenu"
                                style=" @if (Route::currentRouteName() == 'ProductoCategoria' or Route::currentRouteName() == 'marcas' or Route::currentRouteName() == 'productos') display: block; @else  display: none; @endif">
                                @if (canView('Producto - Tabla'))
                                    <li>
                                        <a href="{{ url('productos') }}"
                                            class="{{ Route::currentRouteName() == 'productos' ? 'active' : '' }}">
                                            Listado Productos
                                        </a>
                                    </li>
                                @endif
                                @if (canView('Categoria-Producto - Tabla'))
                                    <li>
                                        <a href="{{ url('ProductoCategoria') }}"
                                            class="{{ Route::currentRouteName() == 'ProductoCategoria' ? 'active' : '' }}">
                                            Categoria de Producto
                                        </a>
                                    </li>
                                @endif
                                @if (canView('Brands - Tabla'))
                                    <li>
                                        <a href="{{ url('marcas') }}"
                                            class="{{ Route::currentRouteName() == 'marcas' ? 'active' : '' }}">
                                            Marcas
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (canView('Inventorie - Tabla'))
                        <li class="sidebar-list">
                            {{-- <label class="badge badge-success">2</label> --}}
                            <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'ajusteInventario' ? 'active' : '' }}"
                                href="{{ url('ajusteInventario') }}">
                                <i data-feather="layers"></i><span class="lan-6">Ajuste de Stock</span></a>
                        </li>
                    @endif
                    @if (canView('Inventorie - Tabla'))
                        <li class="sidebar-list">
                            {{-- <label class="badge badge-success">2</label> --}}
                            <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'modoPago' ? 'active' : '' }}"
                                href="{{ url('modoPago') }}">
                                <i data-feather="credit-card"></i><span class="lan-6">Modo de pago</span></a>
                        </li>
                    @endif
                    @if (canView('Taxes - Tabla'))
                        <li class="sidebar-list">
                            {{-- <label class="badge badge-success">2</label> --}}
                            <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'impuestos' ? 'active' : '' }}"
                                href="{{ url('impuestos') }}">
                                <i data-feather="target"></i><span class="lan-6">Impuestos</span></a>
                        </li>
                    @endif
                    @if (canView('Shopping - Tabla'))
                        <li class="sidebar-list">
                            {{-- <label class="badge badge-success">2</label> --}}
                            <a class="sidebar-link sidebar-title @if (Route::currentRouteName() == 'compras' or Route::currentRouteName() == 'comprasCrear') active @endif"
                                href="{{ url('compras') }}">
                                <i data-feather="shopping-bag"></i><span class="lan-6">Compras</span></a>
                        </li>
                    @endif
                    @if (canView('Invoice - Tabla'))
                        <li class="sidebar-list">
                            {{-- <label class="badge badge-success">2</label> --}}
                            <a class="sidebar-link sidebar-title @if (Route::currentRouteName() == 'ventas' or Route::currentRouteName() == 'ventasCrear') active @endif"
                                href="{{ url('ventas') }}">
                                <i data-feather="shopping-cart"></i><span class="lan-6">Ventas</span></a>
                        </li>
                    @endif
                    {{-- @if (canView('Shopping - Tabla') or canView('Taxes - Tabla'))
                        <li class="sidebar-list"><a
                                class="sidebar-link sidebar-title @if (Route::currentRouteName() == 'compras' or Route::currentRouteName() == 'impuestos') active @endif"
                                href="#"><i data-feather="gift"></i><span class="lan-6">Compras</span>
                                <div class="according-menu"><i
                                        class="@if (Route::currentRouteName() == 'compras' or Route::currentRouteName() == 'impuestos') fa fa-angle-down @else  fa fa-angle-right @endif"></i>
                                </div>
                            </a>
                            <ul class="sidebar-submenu"
                                style=" @if (Route::currentRouteName() == 'compras' or Route::currentRouteName() == 'impuestos') display: block; @else  display: none; @endif">
                                @if (canView('Shopping - Tabla'))
                                    <li>
                                        <a href="{{ url('compras') }}"
                                            class="{{ Route::currentRouteName() == 'compras' ? 'active' : '' }}">
                                            Compras
                                        </a>
                                    </li>
                                @endif
                                @if (canView('Taxes - Tabla'))
                                    <li>
                                        <a href="{{ url('impuestos') }}"
                                            class="{{ Route::currentRouteName() == 'impuestos' ? 'active' : '' }}">
                                            Impuestos
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class="sidebar-list">
                            <li>
                                <br>
                                <br>
                            </li>
                        </li>
                    @endif --}}
                    <li>
                        <br>
                        <br>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>

</div>
