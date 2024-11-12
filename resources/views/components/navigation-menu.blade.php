<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
            <img src="{{asset ('/assets/img/favicon - copia.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 text-dark font-weight-bold">DSRSMH - PIURA</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class=" " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="../pages/dashboard.html">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-grip-vertical text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text text-dark ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">CONTROL DE PERMISOS</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#submenu" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="fas me-2 	fa-industry text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark ms-1">Organización</span>
                </a>
                <!-- Submenú desplegable -->
                <ul class="collapse nav flex-column ms-4" id="submenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('areas.index')}}">
                            <i class="fas me-2 fa-project-diagram text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">Areas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('usuarios.index')}}">
                            <i class="fa me-2 fa-users text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">Usuarios</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">CONTROL DE ACTIVOS INFORMATICOS</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route ('equipos.index')}}">
                    <i class="fas me-2 fa-laptop text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark ms-1">Activos informaticos</span>
                </a>
                <!-- Sub-navegación anidada -->
                <ul class="nav flex-column ms-4">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('equipos.create')}}">
                            <i class="far me-2 fa-plus-square text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">Registrar</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">CONTROL DE PRESTAMOS</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#submenu-prestamos" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="fas me-2 fa-route text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark ms-1">Prestamos</span>
                </a>
                <!-- Submenú desplegable -->
                <ul class="collapse nav flex-column ms-4" id="submenu-prestamos">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('activosdisponibles')}}">
                            <i class="fas me-2 fa-folder-open text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">Generar prestamo</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('prestamos.index')}}">
                            <i class="fas me-2 fa-chart-line text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">Control de prestamos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('usuarios.index')}}">
                            <i class="fas me-2 fa-history text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">Historial</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">CONTROL DE MANTENIMIENTOS CORRECTIVOS</h6>
            </li>



           
            <!--<li class="nav-item">
                <a class="nav-link" href="#submenu">
                    <i class="fas me-2 fa-sign-out-alt text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark ms-1">Cerrar sesión</span>
                </a>
            </li>-->
        </ul>
    </div>

</aside>