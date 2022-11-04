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
    <!-- Nucleo Icons -->
    <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- magnific popup -->
    <link rel="stylesheet" href="/assets/Magnific-Popup-master/dist/magnific-popup.css">
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />

</head>
<body class="g-sidenav-show  bg-gray-200">
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg  pt-1 pb-0">
            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3"></a>Envio de comprobante</h6>
        </div>
    </div>
    <div class="card-body px-0 pb-4">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <a class="image-link" href="https://testing.asparecargas.net{{$voucher}}">
                        <img class="image-link" width="200px" height="200px" src="https://testing.asparecargas.net{{$voucher}}">
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <form method="get" action="https://api.whatsapp.com/send">
                            <div class="input-group input-group-outline">
                                <label class="form-label" for="number">Número</label>
                                <input type="hidden" value="{{ $message. 'https://testing.asparecargas.net/transaction/detail-pdf/'.$transactionID }}" name="text">
                                <input class="form-control" type="number" min="0" name="phone">
                            </div>
                </div>
            </div>
            <div class="row justify-content-center" style="margin-top: 10px">
                <div class="col-auto">
                    <input class="btn btn-success" type="submit">
                </div>
            </div>
        </form>
</div>
<!--   Core JS Files   -->
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="/assets/js/plugins/chartjs.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<!-- Magnific-Popup -->
<script src="/assets/Magnific-Popup-master/dist/jquery.magnific-popup.js"></script>
<script>
    $(document).ready(function() {
        $('.image-link').magnificPopup({
            type:'image'
        });
    });
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/js/material-dashboard.min.js?v=3.0.0"></script>

<!--Import axios-->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function() {
        $('.image-link').magnificPopup({
            type:'image'
        });
    });
</script>
</body>
