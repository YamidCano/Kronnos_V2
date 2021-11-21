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
                            <img class="img-70 rounded-circle" alt="" src="https://ui-avatars.com/api/?name={{Auth::user()->first_name}}.'&color=FFFFFF&background=e74c3c">
                            <div>
                                <h5 class="mb-1 text-danger">{{Auth::user()->first_name}}</h5>
                                   <p>Administrador</p>
                            </div>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        {{-- <label class="badge badge-success">2</label> --}}
                        <a class="sidebar-link sidebar-title" href="{{ url('home') }}"><i
                                data-feather="home"></i><span class="lan-6">Dashboard </span></a>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i
                                data-feather="users"></i><span class="lan-6">Usuarios</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ url('usuarios') }}">Listado de Usuarios</a></li>
                            <li><a href="{{ url('rolesPermisos') }}">Roles y Permisos</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
