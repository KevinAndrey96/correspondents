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
    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!--JQuery maskedinput-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>
    <!--Highcharts-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <!--autoNumeric.js-->
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.10.3/dist/autoNumeric.min.js"></script>
    <!-- magnific popup -->
    <link rel="stylesheet" href="/assets/Magnific-Popup-master/dist/magnific-popup.css">
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <!--Datepicker-->
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

</head>
<!--background-image: linear-gradient(195deg, #42924a 0%, #191919 100%);-->
<body class="g-sidenav-show  bg-gray-200">

    @if (isset(Auth::user()->brand_id))
        <aside style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%)" class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
            @else
                <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
                    @endif
    <div class="sidenav-header text-center p-2">
        <a class="text-center p-3" href="/home">
            @if (isset(Auth::user()->brand_id))
                <img style="margin-top: -3px;" src="{{getenv('URL_SERVER').Auth::user()->brand->square_logo_url}}" height="auto" width="30%" class="text-center" alt="main_logo" >
                    @else
                <img style="margin-top: -3px;" src="/assets/img/favicon1.png" height="auto" width="30%" class="text-center" alt="main_logo" >
                            @endif
            <span class="ms-1 font-weight-bold text-white "></span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 mb-4 " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white " href="/home">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">home</i>
                    </div>
                    <span class="nav-link-text ms-1">Inicio</span>
                </a>
            </li>
        @hasrole('Administrator')
            <li class="nav-item">
                <a class="nav-link text-white " href="{{route('shopkeeper.top.date')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">military_tech</i>
                    </div>
                    <span class="nav-link-text ms-1">Top tenderos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-24" aria-expanded="false" aria-controls="submenu-24">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="width:30px; margin-left: -5px;" class="fas fa-cogs"></i>
                    </div>
                    <span class="nav-link-text">Configuración</span>
                </a>
                <div id="submenu-24" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{route('banners.index')}}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">width_full</i>
                                </div>
                                <span class="nav-link-text ms-1">Banners</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{route('cards')}}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">credit_card</i>
                                </div>
                                <span class="nav-link-text ms-1">Tarjetas de recaudo</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{route('answers.index')}}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">filter_list</i>
                                </div>
                                <span class="nav-link-text ms-1">Respuestas pre-cargadas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{route('transactions.fields')}}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">text_fields</i>
                                </div>
                                <span class="nav-link-text ms-1">Campos transacciones</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{route('publicity.index')}}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">newspaper</i>
                                </div>
                                <span class="nav-link-text ms-1">Publicidad</span>
                            </a>
                        </li>
                        @if (getenv('COUNTRY_NAME') == 'ECUADOR')
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{route('exchanges.index')}}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                                <span class="nav-link-text ms-1">Tasas de cambio</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{route('brands.index')}}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">branding_watermark</i>
                                </div>
                                <span class="nav-link-text ms-1">Marcas blancas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
						        <i style="width:30px; margin-left: -5px;" class="fas fa-user-tie"></i>
						         </div>
                    <span class="nav-link-text">Usuarios</span>
                </a>
                <div id="submenu-2" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/users?role=Administrator">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">person</i>
                                </div>
                                <span class="nav-link-text ms-1">G. Administradores</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/users?role=Supplier">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">people</i>
                                </div>
                                <span class="nav-link-text ms-1">G. Proveedores</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/users?role=Distributor">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">groups</i>
                                </div>
                                <span class="nav-link-text ms-1">G. Distribuidores</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/users?role=allShopkeepers">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">groups</i>
                                </div>
                                <span class="nav-link-text ms-1">G. Tenderos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/users?role=Saldos">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">groups</i>
                                </div>
                                <span class="nav-link-text ms-1">G. Usuarios S & G</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/users?role=Advisers">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">groups</i>
                                </div>
                                <span class="nav-link-text ms-1">G. Asesores</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="/products">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">credit_score</i>
                    </div>
                    <span class="nav-link-text ms-1">G. Productos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-8" aria-expanded="false" aria-controls="submenu-8">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">payments</i>
                    </div>
                    <span class="nav-link-text ms-2">Comisiones</span>
                </a>
                <div id="submenu-8" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{route('commissions.groups')}}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Grupos de comisiones</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li style="display: none;" class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-4" aria-expanded="false" aria-controls="submenu-2">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">card_travel</i>
                    </div>
                    <span class="nav-link-text">Productos</span>
                </a>
                <div id="submenu-4" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">

                        <li class="nav-item">
                            <a class="nav-link text-white " href="/products">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">credit_score</i>
                                </div>
                                <span class="nav-link-text ms-1">G. Productos</span>
                            </a>
                        </li>
                        <li class="nav-item" style="display: none;">
                            <a class="nav-link text-white " href="/commissions/users?id=supdis">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">price_change</i>
                                </div>
                                <span class="nav-link-text ms-1">G. Comisiones</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-6" aria-expanded="false" aria-controls="submenu-2">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="width:30px; margin-left: -5px;" class="material-icons opacity-10">price_check</i>
                    </div>
                    <span class="nav-link-text">Transacciones</span>
                </a>
                <div id="submenu-6" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/transactions?id=record">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">

                                </div>
                                <span class="nav-link-text ms-1">Últimas transacciones</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="submenu-6" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/transactions?id=record2">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">post_add</i>
                                </div>
                                <span class="nav-link-text ms-1">Todas las transacciones</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-3" aria-expanded="false" aria-controls="submenu-2">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="width:30px; margin-left: -5px;" class="material-icons opacity-10">monetization_on</i>

                    </div>
                    <span class="nav-link-text">Saldos</span>
                </a>
                <div id="submenu-3" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/balance">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">payments</i>
                                </div>
                                <span class="nav-link-text ms-1">Solicitudes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/balance-all">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">payments</i>
                                </div>
                                <span class="nav-link-text ms-1">Historial de solicitudes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/balance/users">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">price_check</i>
                                </div>
                                <span class="nav-link-text ms-1">Saldo por usuario</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endhasrole

        @hasrole('Distributor')
            <li class="nav-item">
                <a class="nav-link text-white " href="/users?role=Shopkeeper">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">store</i>
                    </div>
                    <span class="nav-link-text ms-1">G. Tenderos</span>
                </a>
            </li>
            <li class="nav-item" style="display: none;">
                <a class="nav-link text-white " href="/commissions/users?id=shopkeeper">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">credit_card</i>
                    </div>
                    <span class="nav-link-text ms-1">G. Comisiones</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="/commissions">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">payments</i>
                    </div>
                    <span class="nav-link-text ms-1">Comisiones</span>
                </a>
            </li>
        @endhasrole

        @hasrole('Shopkeeper')
            <li class="nav-item">
                <a class="nav-link text-white " href="/commissions">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">payments</i>
                    </div>
                    <span class="nav-link-text ms-1">Comisiones</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-6" aria-expanded="false" aria-controls="submenu-2">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="width:30px; margin-left: -5px;" class="material-icons opacity-10">price_check</i>
                    </div>
                    <span class="nav-link-text">Transacciones</span>
                </a>
                <div id="submenu-6" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        @if (is_null(session('impersonated_by')))
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/transactions/create">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">post_add</i>
                                </div>
                                <span class="nav-link-text ms-1">Nueva Transacción</span>
                            </a>
                        </li>
                        @if (getenv('COUNTRY_NAME') == 'ECUADOR')
                            <li class="nav-item">
                                <a class="nav-link text-white " href="/giros/create?giros=1">
                                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                        <i class="material-icons opacity-10">post_add</i>
                                    </div>
                                    <span class="nav-link-text ms-1">Nuevo Giro Internacional</span>
                                </a>
                            </li>
                        @endif
                        @endif
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/transactions">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                                <span class="nav-link-text ms-1">Mis Transacciones</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-5" aria-expanded="false" aria-controls="submenu-2">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="width:30px; margin-left: -5px;" class="material-icons opacity-10">monetization_on</i>
                    </div>
                    <span class="nav-link-text">Saldos</span>
                </a>
                <div id="submenu-5" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        @if (is_null(session('impersonated_by')))
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/balance/create">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">new_label</i>
                                </div>
                                <span class="nav-link-text ms-1">Recargar Saldo</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/balance">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">history_edu</i>
                                </div>
                                <span class="nav-link-text ms-1">Historial Saldos</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
        @endhasrole

        @hasrole('Supplier')
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-6" aria-expanded="false" aria-controls="submenu-2">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="width:30px; margin-left: -5px;" class="material-icons opacity-10">price_check</i>
                    </div>
                    <span class="nav-link-text">Transacciones</span>
                </a>
                <div id="submenu-6" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/transactions">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                                <span class="nav-link-text ms-1">Transacciones en espera</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/transactions?id=record">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">post_add</i>
                                </div>
                                <span class="nav-link-text ms-1">Historial de transacciones</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @if (getenv('COUNTRY_NAME') == 'ECUADOR' && Auth::user()->giros == 1)
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-7" aria-expanded="false" aria-controls="submenu-2">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="width:30px; margin-left: -5px;" class="material-icons opacity-10">price_check</i>
                    </div>
                    <span class="nav-link-text">Giros</span>
                </a>
                <div id="submenu-7" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/transactions">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                                <span class="nav-link-text ms-1">Giros en espera</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/transactions?id=record">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">post_add</i>
                                </div>
                                <span class="nav-link-text ms-1">Historial de giros</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-5" aria-expanded="false" aria-controls="submenu-2">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="width:30px; margin-left: -5px;" class="material-icons opacity-10">monetization_on</i>
                    </div>
                    <span class="nav-link-text">Saldos</span>
                </a>
                <div id="submenu-5" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">

                        <li class="nav-item">
                            <a class="nav-link text-white " href="/balance/create">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">new_label</i>
                                </div>
                                <span class="nav-link-text ms-1">Recargar Saldo</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/balance">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">history_edu</i>
                                </div>
                                <span class="nav-link-text ms-1">Historial Saldos</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="/commissions">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">payments</i>
                    </div>
                    <span class="nav-link-text ms-1">Comisiones</span>
                </a>
            </li>
        @endhasrole
            @if (Auth::user()->role == 'Saldos')
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-3" aria-expanded="false" aria-controls="submenu-2">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="width:30px; margin-left: -5px;" class="material-icons opacity-10">monetization_on</i>

                        </div>
                        <span class="nav-link-text">Saldos</span>
                    </a>
                    <div id="submenu-3" class="collapse " data-bs-parent="#menu-accordion">
                        <ul class="submenu-list list-unstyled">
                            <li class="nav-item">
                                <a class="nav-link text-white " href="/balance">
                                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                        <i class="material-icons opacity-10">payments</i>
                                    </div>
                                    <span class="nav-link-text ms-1">Solicitudes</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white " href="/balance-all">
                                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                        <i class="material-icons opacity-10">payments</i>
                                    </div>
                                    <span class="nav-link-text ms-1">Historial de solicitudes</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white " href="/balance/users">
                                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                        <i class="material-icons opacity-10">price_check</i>
                                    </div>
                                    <span class="nav-link-text ms-1">Saldo por usuario</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-9" aria-expanded="false" aria-controls="submenu-2">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">savings</i>
                    </div>
                    <span class="nav-link-text">Ganancias</span>
                </a>
                <div id="submenu-9" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Saldos')
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/profit/users">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">request_quote</i>
                                </div>
                                <span class="nav-link-text ms-1">Solicitudes</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->role !== 'Saldos' && is_null(session('impersonated_by')))
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/profit/create">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">exit_to_app</i>
                                </div>
                                <span class="nav-link-text ms-1">Retirar Ganancia</span>
                            </a>
                        </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link text-white " href="/profit">
                                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                        <i class="material-icons opacity-10">history</i>
                                    </div>
                                    <span class="nav-link-text ms-1">Historial de Retiros</span>
                                </a>
                            </li>
                    </ul>
                </div>
            </li>
            @hasrole('Shopkeeper')
            <li class="nav-item">
                <a class="nav-link text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{(getenv('COUNTRY_NAME') == 'COLOMBIA')  ? '57'.Auth::user()->distributor->phone : '593'.Auth::user()->distributor->phone}} ">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">payments</i>
                    </div>
                    <span class="nav-link-text ms-1">Contactar Distribuidor</span>
                </a>
            </li>
            @endhasrole
        </ul>
    </div>
    @hasrole('Supplier')
    <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="form-check form-switch ">
                    <label></label>
                    <label id="onlineLabel">
                        @if (Auth::user()->is_online == 1)
                            Online</label>
                    <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{Auth::user()->id}}" checked onchange="changeOnlineStatus({{ Auth::user()->id}})">
                    <label class="form-check-label text-body ms-0 text-truncate w-80" for="togglestatus{{Auth::user()->id}}"></label>
                    @else
                        Offline </label>
                        <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{ Auth::user()->id }}" onchange="changeOnlineStatus({{ Auth::user()->id }})">
                        <label class="form-check-label text-body ms-0 text-truncate w-0 mb-80" for="togglestatus{{ Auth::user()->id }}"></label>
                    @endif
                </div>
                <form id="form-status" name="form-status" method="POST" action="{{ url('/changeOnlineStatusUser') }}">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="status" id="status">
                </form>
                <script>
                    function changeOnlineStatus(id)
                    {
                        let toggle = document.getElementById("togglestatus" + id);
                        let status = document.getElementById("status");
                        let form = document.getElementById("form-status");
                        let supplier_id = document.getElementById("id");

                        if (toggle.checked == true) {
                            status.value = 1;
                            document.getElementById("onlineLabel").innerHTML = 'Online';
                        } else {
                            status.value = 0;
                            document.getElementById("onlineLabel").innerHTML = 'Offline';
                        }
                        supplier_id.value = id;
                        form.submit();
                    }
                </script>
                <div class="docs-info">
                    <h6 class="mb-0 text-white">¡ Recuerda !</h6>
                    <p class="text-xs text-white mb-0">Enciende el switch al iniciar y apágalo cuando culmines tu jornada</p>
                </div>
            </div>
        </div>
    </div>
    @endhasrole
    @hasrole('Administrator')
    <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="form-check form-switch ">
                    <label></label>
                    <label id="onlineLabel">
                        @if (($platform = App\Models\Platform::find(1))->is_enabled == 1)
                            Online</label>
                    <input class="form-check-input ms-auto" type="checkbox" id="togglePlatformStatus{{$platform->id}}" checked onchange="getPlatformStatus({{$platform->id}})">
                    <label class="form-check-label text-body ms-0 text-truncate w-80" for="togglePlatformStatus{{$platform->id}}"></label>
                    @else
                        Offline </label>
                        <input class="form-check-input ms-auto" type="checkbox" id="togglePlatformStatus{{$platform->id}}" onchange="getPlatformStatus({{$platform->id}})">
                        <label class="form-check-label text-body ms-0 text-truncate w-0 mb-80" for="togglePlatformStatus{{$platform->id}}"></label>
                    @endif
                </div>
                <form id="form-platform-status" name="form-platform-status" method="POST" action="{{route('platform.lock')}}">
                    @csrf
                    <input type="hidden" name="id" id="platform_id">
                    <input type="hidden" name="status" id="platform_status">
                </form>
                <script>
                    function getPlatformStatus(id)
                    {
                        console.log('ok');
                        let toggle = document.getElementById("togglePlatformStatus" + id);
                        let status = document.getElementById("platform_status");
                        let form = document.getElementById("form-platform-status");
                        let platform_id = document.getElementById("platform_id");

                        if (toggle.checked == true) {
                            status.value = 1;
                            document.getElementById("onlineLabel").innerHTML = 'Online';
                        } else {
                            status.value = 0;
                            document.getElementById("onlineLabel").innerHTML = 'Offline';
                        }
                        platform_id.value = id;
                        form.submit();
                    }
                </script>
                <div class="docs-info">
                    <h6 class="mb-0 text-white">¡ Recuerda !</h6>
                    <p class="text-xs text-white mb-0">Habilita o deshabilita la plataforma transaccional</p>
                </div>
            </div>
        </div>
    </div>
    @endhasrole

    <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <div class="card-body text-center p-3 w-100 pt-0">
                @if(Auth::user()->role == 'Shopkeeper')
                <h6 class="text-white mb-1">Tendero</h6>
                @endif
                @if(Auth::user()->role == 'Supplier')
                <h6 class="text-white mb-1">Proveedor</h6>
                @endif
                @if(Auth::user()->role == 'Administrator')
                <h6 class="text-white mb-1">Administrador</h6>
                @endif
                @if(Auth::user()->role == 'Distributor')
                <h6 class="text-white mb-1">Distribuidor</h6>
                @endif
                    @if (Auth::user()->role !== 'Saldos')
                        <p class="text text-white mb-1">Ganancia: ${{ number_format(Auth::user()->profit, 2, ',', '.') }}
                            @hasanyrole('Supplier|Shopkeeper')
                        </br> Saldo: ${{ number_format(Auth::user()->balance, 2, ',', '.') }}
                            @endhasanyrole
                        </p>
                    @endif
            </div>
            <div style="display: none;" class="card-body text-center p-2 pt-1">
                <a class="btn btn-white text-dark "  href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                        <span class="nav-link-text ms-1 ps-2">Salir</span>
                    </div>

                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark">Bienvenido</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ Auth::user()->name}}.</li>
                </ol>

            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <!--<div class="input-group input-group-outline">
                      <label class="form-label">Buscar...</label>
                      <input type="text" class="form-control">
                    </div>-->
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                        </a>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown ps-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-cog cursor-pointer"></i>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="/changePassword">
                                    <i class="fas fa-user-edit  me-3"></i> Cambiar contraseña
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt  me-4"></i>Cerrar sesión
                                </a>
                            </li>
                            @if (session('impersonated_by'))
                                <li>
                                    <a class="dropdown-item" href="{{route('mode.spectator', ['id'=> 1, 'isInspector' => 0]) }}"><i class="fas fa-exchange-alt me-4"></i>Volver a mi sesión</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if(session('impersonated_by'))
        <div class="d-flex justify-content-center p-3">
            <img style="margin-top: -3px;" src="{{getenv('URL_SERVER')}}/assets/img/phantom_mode.png" height="auto" width="30%" class="text-center" alt="main_logo" >
        </div>
    @endif
    <!-- End Navbar -->
    @yield('content')
    <!-- footer -->
    <footer class="footer">
            <div class="container-fluid">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @if (! isset($banners))
                            @if (App\Models\Banner::all()->count() > 0 && (Auth::user()->role == 'Distributor' || Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Saldos'))
                                @foreach(App\Models\Banner::all() as $banner)
                                    @if ($banner->id == App\Models\Banner::first()->id)
                                        <div class="carousel-item active">
                                            <img class="d-block w-100 rounded img-fluid" src="{{getenv('URL_SERVER').$banner->banner_url}}">
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img class="d-block w-100 rounded img-fluid" src="{{getenv('URL_SERVER').$banner->banner_url}}">
                                        </div>
                                    @endif
                                @endforeach
                            @else
                            <div class="carousel-item active">
                                <img class="d-block w-100 rounded img-fluid" src="{{getenv('URL_SERVER')}}/assets/img/Banner/banner_original.png">
                            </div>
                            @endif
                        @endif

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="row align-items-center justify-content-lg-between">
                    <div  class="col-lg-12 mb-lg-0 mb-4">
                        <!--
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>
                            Desarrollado por
                            <a href="https://asparecargas.net" class="font-weight-bold" target="_blank">Asparecargas</a>
                            Todos los derechos reservados.
                        </div>
                        -->
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
<script src="/assets/js/plugins/chartjs.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<!-- Magnific-Popup -->
<script src="/assets/Magnific-Popup-master/dist/jquery.magnific-popup.js"></script>
<script type="text/javascript">
    $('.image-link').magnificPopup({
        type: 'image'
    });
</script>
<script>
    @if (Auth::user()->role == 'Supplier')
        var contadorAfk = 0;
        $(document).ready(function() {
                setInterval(ctrlTiempo, 60000);
                $(this).mousemove(function (e) {
                    contadorAfk = 0;
                });
                $(this).keypress(function (e) {
                    contadorAfk = 0;
                });

                function ctrlTiempo() {
                    let formLogout = document.getElementById('logout-form');
                    contadorAfk++;
                    if (contadorAfk > 59) {
                        formLogout.submit();
                    }
                }
        });
    @endif

</script>
<script>
    $(document).ready(function () {
        carousel_next = document.querySelector('.carousel-control-next');
        setInterval(()=>{
            carousel_next.click();
        }, 3000);
    });
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/js/material-dashboard.min.js?v=3.0.0"></script>

<!--Import axios-->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!--CKEDITOR CDN-->
<script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'richText' );
</script>
                <!--Put figures in amount input-->
                <script type="text/javascript">
                    function formatNumber(id) {
                        const amountInput = document.getElementById(id);
                        amountInput.style.fontSize = "150%";
                        let text = amountInput.value.replace(/[^0-9\.]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        amountInput.value = text;

                        let spotIndex = text.indexOf('.');
                        if (spotIndex != -1) {
                            const charArray = text.split('');
                            let count = 0;

                            for (let i = 0; i < charArray.length; i++) {
                                if (charArray[i] == '.') {
                                    count++;
                                    if (count > 1) {
                                       delete charArray[i];
                                    }
                                }
                            }

                            text = charArray.join('');
                            amountInput.value = text;

                            let textArrayBySpot = text.split('.');

                            if (textArrayBySpot[1].length > 2) {
                                text = textArrayBySpot[0] + '.' + textArrayBySpot[1].slice(0, 2);
                                amountInput.value = text;
                            }
                        }
                    }
                </script>
        <script type="text/javascript">
            $('#datepickerSince').datepicker({
                showOtherMonths: true,
                format: 'yyyy/mm/dd',
            });

            $('#datepickerUntil').datepicker({
                showOtherMonths: true,
                format: 'yyyy/mm/dd',
            });

        </script>

</body>

</html>
