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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3  bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" >
            <img src="/assets/img/LOGO-COMPLETO.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white"></span>
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
                    </ul>
                </div>
            </li>
            <li class="nav-item">
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
                        <li class="nav-item">
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
                                    <i class="material-icons opacity-10">post_add</i>
                                </div>
                                <span class="nav-link-text ms-1">Ver transacciones</span>
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
                            <a class="nav-link text-white " href="/balance/users">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">price_check</i>
                                </div>
                                <span class="nav-link-text ms-1">G. Saldos</span>
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
            <li class="nav-item">
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
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/transactions/create">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">post_add</i>
                                </div>
                                <span class="nav-link-text ms-1">Nueva Transacción</span>
                            </a>
                        </li>
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
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-9" aria-expanded="false" aria-controls="submenu-2">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">savings</i>
                    </div>
                    <span class="nav-link-text">Ganancias</span>
                </a>
                <div id="submenu-9" class="collapse " data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        @hasrole('Administrator')
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/profit/users">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">request_quote</i>
                                </div>
                                <span class="nav-link-text ms-1">Solicitudes</span>
                            </a>
                        </li>
                        @endhasrole
                        <li class="nav-item">
                            <a class="nav-link text-white " href="/profit/create">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">exit_to_app</i>
                                </div>
                                <span class="nav-link-text ms-1">Retirar Ganancia</span>
                            </a>
                        </li>
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
            <li class="nav-item">
                <a class="nav-link text-white "  href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">Salir</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
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
                        var toggle = document.getElementById("togglestatus"+id);
                        var status = document.getElementById("status");
                        var form = document.getElementById("form-status");
                        var supplier_id = document.getElementById("id");

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
                    <h6 class="mb-0 text-white">! Recuerda ¡</h6>
                    <p class="text-xs text-white mb-0">Enciende el switch al iniciar y apágalo cuando culmines tu jornada</p>
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
                <p class="text-xs text-white mb-1">Ganancia: ${{ Auth::user()->profit }}
                    @hasanyrole('Supplier|Shopkeeper')
                </br> Saldo: ${{ Auth::user()->balance }}
                    @endhasanyrole
                </p>
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
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    @yield('content')
    <!-- footer -->
    <footer class="footer">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div  class="col-lg-12 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>
                            Desarrollado por
                            <a href="https://cobol.com.co/" class="font-weight-bold" target="_blank">Cobol Ingeniería</a>
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
<script src="/assets/js/plugins/chartjs.min.js"></script>
<script>

</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/assets/js/material-dashboard.min.js?v=3.0.0"></script>


</body>

</html>
