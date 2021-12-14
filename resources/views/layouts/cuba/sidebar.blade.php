<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="{{ url('home') }}">
                <img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt="">
                <img class="img-fluid for-dark" src="../assets/images/logo/logo.png" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
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
                        <a class="sidebar-link sidebar-title" href="{{ url('home') }}"><i
                                data-feather="home"></i><span class="lan-6">Dashboard </span></a>
                    </li>
                    @if (canView('Usuario - Tabla') or canView('Role y Permisos - Tabla'))
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                                    data-feather="users"></i><span class="lan-6">Usuarios</span></a>
                            <ul class="sidebar-submenu">
                                @if (canView('Usuario - Tabla'))
                                    <li><a href="{{ url('usuarios') }}">Listado de Usuarios</a></li>
                                @endif
                                @if (canView('Role y Permisos - Tabla'))
                                    <li><a href="{{ url('rolesPermisos') }}">Roles y Permisos</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if (canView('Producto - Tabla') or canView('Proveedor - Tabla') or canView('Categoria-Producto - Tabla'))
                        <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                                    data-feather="package"></i><span class="lan-6">Productos</span></a>
                            <ul class="sidebar-submenu">
                                @if (canView('Categoria-Producto - Tabla'))
                                    <li><a href="{{ url('ProductoCategoria') }}">Categoria de Producto</a></li>
                                @endif
                                @if (canView('Proveedor - Tabla'))
                                    <li><a href="{{ url('proveedor') }}">Proveedores</a></li>
                                @endif
                                @if (canView('Producto - Tabla'))
                                    <li><a href="{{ url('productos') }}">Productos</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
