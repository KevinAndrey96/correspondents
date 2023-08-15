<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon1.png">
    <title>
        Corresponsales
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="bg-gray-200">
<main class="main-content  mt-0" >
    <div class="page-header align-items-start min-vh-100" style="background-image: url('/assets/img/bglogin.jpeg'); background-position: center;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            @if ((Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Distributor') && isset(Auth::user()->brand_id))
                                <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg py-2 pe-1">
                                    <h6 class="text-white font-weight-bolder text-center mt-1 mb-1"><img src="{{getenv('URL_SERVER').Auth::user()->brand->rectangular_logo_url}}" width="70%" height="auto"></h6>
                                </div>
                            @else
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-2 pe-1">
                                    <h6 class="text-white font-weight-bolder text-center mt-1 mb-1"><img src="/assets/img/LOGO-COMPLETO.png" width="70%" height="auto"></h6>
                                </div>
                            @endif
                        </div>

                        <div class="card-body">

                            <div class="container">
                                <div class="row justify-content-center align-items-center ">
                                    <div class="col-md-12 col-md-offset-2">
                                        <div class="panel panel-default">
                                            <div class="panel-heading font-weight-bold">Validación con Google Authenticator</div>
                                            <hr>
                                            @if($errors->any())
                                                <div class="col-md-12">
                                                    <div class="alert alert-danger">
                                                        <strong>{{$errors->first()}}</strong>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="panel-body">
                                                <form class="form-horizontal" method="POST" action="{{ route('2fa') }}">
                                                    {{ csrf_field() }}

                                                    <div class="form-group row">
                                                        <p>Por favor ingrese el código  <strong>OTP</strong> generado en su aplicación Google Authenticator. <br> Recuerde que este código es automáticamente regenerado cada 30 segundos.</p>
                                                        <center><p><a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2">App Android</a> |
                                                        <a href="https://apps.apple.com/us/app/google-authenticator/id388497605">App iOs</a></p></center>
                                                        <div class="col-md-6">
                                                            <input id="one_time_password" type="number" style="background-color:lightblue;" class="form-control" name="one_time_password" required autofocus>
                                                        </div>
                                                        @if ((Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Distributor') && isset(Auth::user()->brand_id))
                                                            <div  class="col-md-6" style="text-align: center;"><button type="submit" style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="btn btn-primary">Iniciar sesión</button></div>
                                                        @else
                                                            <div  class="col-md-6" style="text-align: center;"><button type="submit" class="btn btn-primary">Iniciar sesión</button></div>

                                                        @endif
                                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                                            <i class="fas fa-sign-out-alt  me-4"></i>Salir
                                                        </a></div>

                                                    <center>Nota. Si no posee un código pongase en contacto con el administrador</center>
                                                </form>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer position-absolute bottom-2 py-2 w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 my-auto ">
                        <div style="margin-left: 30px;" class="copyright text-center text-sm text-white text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>
                            Desarrollado por
                            <a href="https://asparecargas.net/" class="font-weight-bold text-white" target="_blank">Asparecargas</a>
                            Todos los derechos reservados.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</main>
<!--   Core JS Files   -->
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
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
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>
