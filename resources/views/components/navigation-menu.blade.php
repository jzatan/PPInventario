<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" target="_blank">
            <img src="{{asset ('/assets/img/favicon - copia.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 text-dark font-weight-bold">DSRSMH - PIURA</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class=" " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" style="display: flex; flex-direction: column;" href="{{route('panel')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-grip-vertical text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text text-dark text-center">DASHBOARD</span>
                </a>
            </li>
            @can('ver-areas')
            <li class="nav-item mt-3">
                <h6 class=" text-uppercase text-xs text-center font-weight-bolder opacity-6">Control de usuarios, roles <br> y permisos</h6>
            </li>
            @endcan

            @can('ver-usuarios')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('users.index')}}">
                    <i class="fa-solid fa-user-lock me-2 text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">USUARIOS</span>
                </a>
            </li>
            @endcan
            @can('ver-roles')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('roles.index')}}">
                    <i class="fa-solid fa-key me-2 text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">ROLES Y PERMISOS</span>
                </a>
            </li>
            @endcan
            @can('ver-areas')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('areas.index')}}">
                    <i class="fa-solid fa-sitemap me-2  text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">AREAS</span>
                </a>
            </li>
            @endcan
            @can('ver-empleados')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('usuarios.index')}}">
                    <i class="fa me-2 fa-users text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">EMPLEADOS</span>
                </a>
            </li>
            @endcan
            @can('ver-equipos')
            <li class="nav-item mt-3">
                <h6 class=" text-uppercase text-xs text-center font-weight-bolder opacity-6">Control de activos <br> informaticos</h6>
            </li>
            @endcan
            @can('ver-equipos')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('equipos.index')}}">
                    <i class="fa-solid fa-laptop-file me-2  text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">ACTIVOS <br> INFORMATICOS</span>
                </a>
            </li>
            @endcan
            @can('ver-equipos-registrados-administrador')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('activosregistrados')}}">
                    <i class="fa-solid fa-laptop-file me-2  text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">ACTIVOS <br> INFORMATICOS</span>
                </a>
            </li>
            @endcan
            @can('create-equipos')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('equipos.create')}}">
                    <i class="fa-solid fa-laptop-medical me-2 text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">REGISTRAR ACTIVO </span>
                </a>
            </li>
            @endcan
            <li class="nav-item mt-3">
                <h6 class=" text-uppercase text-xs font-weight-bolder text-center opacity-6">CONTROL DE PRESTAMOS</h6>
            </li>
            @can('ver-equipos-disponibles-prestamos')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('activosdisponibles')}}">
                    <i class="fa-solid fa-person-chalkboard me-2 text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">REGISTRAR <br> PRESTAMOS</span>
                </a>
            </li>
            @endcan
            @can('ver-prestamos')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('prestamos.index')}}">
                    <i class="fas me-2 fa-chart-line text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">CONTROL DE <br> PRESTAMOS</span>
                </a>
            </li>
            @endcan
            <li class="nav-item mt-3">
                <h6 class="text-uppercase text-xs text-center font-weight-bolder opacity-6">CONTROL DE MANTENIMIENTOS</h6>
            </li>
            @can('ver-mantenimientos')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('mantenimientos.index')}}">
                    <i class="fa-solid fa-screwdriver-wrench me-2 text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">CONTROL DE <br>MANTENIMIENTOS <br> CORRECTIVOS</span>
                </a>
            </li>
            @endcan
            @can('ver-mantenimientos-generales')
            <li class="nav-item">
                <a class="nav-link" style="display: flex; flex-direction: column;" href="{{route ('mantenimientosgenerales')}}">
                    <i class="fa-solid fa-screwdriver-wrench me-2 text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark text-center">CONTROL DE <br>MANTENIMIENTOS <br> CORRECTIVOS</span>
                </a>
            </li>
            @endcan




            <!--<li class="nav-item">
                <a class="nav-link" href="#submenu">
                    <i class="fas me-2 fa-sign-out-alt text-dark text-center text-sm opacity-10"></i>
                    <span class="nav-link-text text-dark ms-1">Cerrar sesión</span>
                </a>
            </li>-->
        </ul>
    </div>

</aside>