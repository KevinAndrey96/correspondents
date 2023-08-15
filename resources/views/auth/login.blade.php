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
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            @if (isset($brand))
                                <div style="background-image: linear-gradient(195deg, {{$brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg py-2 pe-1">
                                    <h6 class="text-white font-weight-bolder text-center mt-1 mb-1"><img src="{{getenv('URL_SERVER').$brand->rectangular_logo_url}}" style="max-width:30%" height="auto"></h6>
                                </div>
                            @else
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-2 pe-1">
                                    <h6 class="text-white font-weight-bolder text-center mt-1 mb-1"><img src="/assets/img/LOGO-COMPLETO.png" width="70%" height="auto"></h6>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <form role="form" class="text-start" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Correo</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-white">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div style="display:flex; align-items: center;">
                                    <span style="width:10%; text-align: center;" id="showPass"><a href="#"><i style="" class="material-icons opacity-10 text-primary" onclick="showPass()">visibility</i></a></span>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Contraseña</label>
                                        <input style="width:90%;" id="password" type="password" class="form-control @error('password') is-invalid @enderror border" name="password" required autocomplete="current-password">
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-white">{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <!--
                                <div class="input-group input-group-outline mb-3">
                                    <label class="form-label">Contraseña</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-white">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                -->
                                @if (isset($brand))
                                <div class="text-center">
                                    <button type="submit" style="background-color: {{$brand->primary_color}}" class="btn btn-primary w-100 my-4 mb-2">
                                        {{ __('Iniciar sesión') }}
                                    </button>
                                </div>
                                @else
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary w-100 my-4 mb-2">
                                            {{ __('Iniciar sesión') }}
                                        </button>
                                    </div>
                                @endif
                                <p class="mt-4 text-sm text-center">
                                    <a href="/password/reset" class="text-primary text-gradient font-weight-bold">Recuperar</a> usuario o contraseña

                                </p>
                            </form>
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

<script type="text/javascript">

    function showPass()
    {
        var passInput = document.getElementById('password');

        if (passInput.type == 'password') {
            passInput.type = 'text'
        } else {
            passInput.type = 'password'
        }

        console.log(passInput);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>
