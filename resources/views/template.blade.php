<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href=" {{asset ('/assets/img/favicon - copia.png')}}">

    <title>DSRSMH | @yield('title') </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{asset ('/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href=" {{asset ('/assets/css/nucleo-svg.css')}}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/c1abe62204.js" crossorigin="anonymous"></script>

    <link href=" {{asset ('/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset ('/assets/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />

    @stack('css')
</head>
@auth

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <!--Menu-->
    <x-navigation-menu></x-navigation-menu>
    <main class="main-content position-relative border-radius-lg ">

        <!-- Navbar -->
        <x-navigation-header></x-navigation-header>
        @yield('content')
        <!-- End Navbar -->

        <!--- MODAL CERRAR SESION -->
        <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que deseas cerrar sesión?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="text-white btn bg-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="{{route('logout')}}" type="submit" class="text-white btn bg-primary">Confirmar</a>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!--   Core JS Files   -->
    <script src="{{asset ('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset ('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset ('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset ('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{asset ('assets/js/plugins/chartjs.min.js')}}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset ('assets/js/argon-dashboard.min.js?v=2.0.4')}}"></script>
    <!-- SCRIPT QUE PERMITE OCULTAR EL MENU CUANDO ABRIMOS UN MODAL -->
    <script>
        // Escuchar eventos de apertura y cierre de cualquier modal
        document.addEventListener('show.bs.modal', function() {
            document.getElementById('sidenav-main').style.zIndex = '1020'; // Ajusta el z-index del sidenav
        });

        document.addEventListener('hidden.bs.modal', function() {
            document.getElementById('sidenav-main').style.zIndex = '1030'; // Restaura el z-index del sidenav
        });
    </script>
    @stack('js')
</body>
@endauth
@guest
@include('errors.404')
@endguest

</html>