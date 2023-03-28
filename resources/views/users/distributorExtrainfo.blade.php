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
    <div class="page-header align-items-start min-vh-100" style="background-position: center;">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container my-auto">
            <div class="row">
                <div class="col-lg-4 col-md-8 col-12 mx-auto">
                    <div class="card z-index-0 fadeIn3 fadeInBottom">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-2 pe-1">
                                <h6 class="text-white font-weight-bolder text-center mt-1 mb-1">Información extra</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(count($errors)>0)
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            @if ($error == 'multiproductosID es requerido')
                                                <li>ID multiproductos es requerido</li>
                                            @endif
                                            @if ($error == 'platform_mul es requerido')
                                                <li>Plataforma Multiproductos es requerida</li>
                                            @endif
                                            @if ($error == 'El campo cedula p d f debe ser un archivo de tipo: jpg, jpeg, png, pdf.')
                                                <li>El campo PDF cedula debe ser un archivo de tipo: jpg, jpeg, png, pdf.</li>
                                            @endif
                                            @if ($error == 'El campo rut p d f debe ser un archivo de tipo: jpg, jpeg, png, pdf.')
                                                <li>El campo PDF RUT debe ser un archivo de tipo: jpg, jpeg, png, pdf.</li>
                                            @endif
                                                @if ($error == 'El campo camara comercio debe ser un archivo de tipo: pdf.')
                                                    <li>El campo cámara y comercio debe ser un archivo de tipo: pdf.</li>
                                                @endif
                                                @if ($error == 'El campo local photo debe ser un archivo de tipo: jpg, jpeg, png.')
                                                    <li>El campo foto local debe ser un archivo de tipo: jpg, jpeg, png.</li>
                                                @endif
                                                @if ($error == 'El campo public receipt debe ser un archivo de tipo: jpg, jpeg, png.')
                                                    <li>El campo foto de recibo público debe ser un archivo de tipo: jpg, jpeg, png.</li>
                                                @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(Session::has('unfulfilledRequirements'))
                                <div class="alert alert-danger" role="alert">
                                    <p class="text-center text-sm text-white">{{ Session::get('unfulfilledRequirements') }}</p>
                                </div>
                            @endif
                            <form role="form" class="text-start" method="POST" action="{{ route('store.distributor.extrainfo') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">ID Multiproductos</label>
                                            <input id="multiproductosID" type="text" class="form-control" name="multiproductosID" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Plataforma</label>
                                            <input id="platform_mul" type="text" class="form-control" name="platform_mul" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="cedulaPDF" class="">PDF o Imagen de Cedula:</label>
                                            <input id="cedulaPDF" type="file" class="form-control-file" name="cedulaPDF" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="rutPDF" class="">
                                                @if (Session::get('rutName') == 'RUT')
                                                    PDF o Imagen de RUT:
                                                @endif
                                                    @if (Session::get('rutName') == 'RUC')
                                                        PDF o Imagen de RUC:
                                                    @endif
                                            </label>
                                            <input id="rutPDF" type="file" class="form-control-file" name="rutPDF" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="camara_comercio" class="">
                                                @if (Session::get('rutName') == 'RUT')
                                                    PDF o Imagen de Cámara y comercio (opcional):
                                                @endif
                                                    @if (Session::get('rutName') == 'RUC')
                                                        PDF o Imagen de SRI:
                                                    @endif
                                            </label>
                                            <input id="camara_comercio" type="file" class="form-control-file" name="camara_comercio" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="local_photo" class="">Foto local:</label>
                                            <input id="local_photo" type="file" class="form-control-file" name="local_photo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="public_receipt" class="">
                                                @if (Session::get('rutName') == 'RUT')
                                                    Foto de recibo público:
                                                @endif
                                                @if (Session::get('rutName') == 'RUC')
                                                    PDF o Imagen de planilla:
                                                @endif

                                            </label>
                                            <input id="public_receipt" type="file" class="form-control-file" name="public_receipt" required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success bg-gradient w-100 my-4 mb-2">
                                            {{ __('Guardar') }}
                                        </button>
                                    </div>
                                </div>
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
