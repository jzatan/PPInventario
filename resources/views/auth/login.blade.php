<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Login
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset ('/assets/css/nucleo-icons.css')}}" rel="stylesheet" />

  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->

        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl- col-lg- col-md-4 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-center">
                  <img src="assets\img\log-login.png" alt="Logo" class="img-fluid" style="width: 150px; height:auto; margin-bottom: 30px;">

                  <h4 class="font-weight-bolder">
                    Inicia sesión
                  </h4>
                  <p class="mb-0">
                    Ingrese su correo electrónico y contraseña para iniciar sesión
                  </p>
                </div>
                <div class="card-body">


                  <form role="form" action="/login" method="post">
                    @csrf
                    <div class="mb-3">
                      <input type="text" name="email" class="form-control form-control-lg" placeholder="Correo" aria-label="email">
                    </div>
                    <div class="mb-3 position-relative">
                      <input type="text" id="contraseña" name="password" class="form-control form-control-lg" placeholder="Contraseña" aria-label="contraseña" autocomplete="off">
                      <button type="button" id="togglePassword" class="btn btn-sm btn-outline-secondary position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                        Mostrar
                      </button>
                    </div>

                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">
                        Recuérdame
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">
                        Inicia sesión
                      </button>
                    </div>
                  </form>

                  <script>
                    const togglePasswordButton = document.getElementById('togglePassword');
                    const passwordInput = document.getElementById('password');

                    togglePasswordButton.addEventListener('click', function() {
                      // Cambia el tipo del input
                      if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        togglePasswordButton.textContent = 'Ocultar';
                      } else {
                        passwordInput.type = 'password';
                        togglePasswordButton.textContent = 'Mostrar';
                      }
                    });
                  </script>

                </div>
              </div>
              <div class="col-6  col-md-8 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('/assets/img/portada.png'); background-size: cover;">
                  <span class="mask bg-gradient-primary opacity-3"></span>

                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>