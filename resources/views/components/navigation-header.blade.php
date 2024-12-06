<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5white text-white" href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">@yield('header-nav')</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">@yield('header')</h6>
        </nav>
        <div class="collapse navbar-nav  justify-content-end navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <nav aria-label="breadcrumb">
                <a href="" data-bs-toggle="modal" data-bs-target="#logout">
                    <h6 class="font-weight-bolder text-white mb-0"> Bienvenido {{auth()->user()->name ?? ''}}</h6>
                </a>
                <h6 class="opacity-5 white text-white mb-0 text-end"> {{auth()->user()->areas->nombre_area ?? ''}}</h6>
            </nav>
        </div>
    </div>
</nav>