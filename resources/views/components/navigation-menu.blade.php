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
                    <span class="nav-link-text text-dark ms-1">DASHBOARD</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route ('users.index')}}">
                    <i class="fa me-2 fa-users text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark">USUARIOS</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route ('roles.index')}}">
                    <i class="fa me-2 fa-users text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark">ROLES</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#submenu" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="fa-solid fa-building-user me-2 text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark ms-1">ORGANIZACIÓN</span>
                </a>
                <!-- Submenú desplegable -->
                <ul class="collapse nav flex-column ms-4" id="submenu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('areas.index')}}">
                            <i class="fa-solid fa-sitemap me-2  text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">AREAS</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('usuarios.index')}}">
                            <i class="fa me-2 fa-users text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">EMPLEADOS</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#submenu-informatica" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="fa-solid fa-computer me-2 text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark ms-1">ACT. INFORMATICOS</span>
                </a>
                <!-- Submenú desplegable -->
                <ul class="collapse nav flex-column ms-4" id="submenu-informatica">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('equipos.index')}}">
                            <i class="fa-solid fa-database me-2  text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">CONTROL DE ACT.</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('equipos.create')}}">
                            <i class="fa-solid fa-laptop-medical me-2 text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">REGISTRAR ACTIVO</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#submenu-prestamos" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="fas me-2 fa-route text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark ms-1">PRESTAMOS</span>
                </a>
                <!-- Submenú desplegable -->
                <ul class="collapse nav flex-column ms-4" id="submenu-prestamos">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('activosdisponibles')}}">
                            <i class="fas me-2 fa-folder-open text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">REG. PRESTAMO</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('prestamos.index')}}">
                            <i class="fas me-2 fa-chart-line text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">CONTROL DE PRES.</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#submenu-mantenimiento" data-bs-toggle="collapse" aria-expanded="false">
                    <i class="fa-solid fa-gear me-2 text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark ms-1">MANTENIMIENTOS</span>
                </a>
                <!-- Submenú desplegable -->
                <ul class="collapse nav flex-column ms-4" id="submenu-mantenimiento">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route ('mantenimientos.index')}}">
                            <i class="fas me-2 fa-chart-line text-dark text-center text-sm opacity-10"></i>
                            <span class="nav-link-text text-dark">CONTROL DE MAN.</span>
                        </a>
                    </li>
                </ul>
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