@extends('layouts.dashboard')
@section('content')
    @if(Session::has('deniedAccess'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('deniedAccess') }}
        </div>
    @endif
    @if(Session::has('transactionAccepted'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('transactionAccepted') }}
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @if (isset($banners))
                        @if ($banners->count() > 0 && (Auth::user()->role == 'Distributor' || Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Saldos'))
                            @foreach($banners as $banner)
                                @if ($banner->id == $firstBanner->id)
                                    <div class="carousel-item active">
                                        <img class="d-block w-100 rounded img-fluid" src="{{$urlServer.$banner->banner_url}}">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img class="d-block w-100 rounded img-fluid" src="{{$urlServer.$banner->banner_url}}">
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @else
                        <div class="carousel-item active">
                            <img class="d-block w-100 rounded img-fluid" src="{{$urlServer}}/assets/img/Banner/banner_original.png">
                        </div>
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
        </div>
    </div>
    <div class="container-fluid py-2">
        <div class="row">
            @if (Auth::user()->role != 'Distributor')
                <div class="col-md-12">
                    <div class="row justify-content-center pt-5 pb-5">
                        <div class="col-md-3 d-flex justify-content-center pt-2 mb-2">
                            <label><span class="me-1 font-weight-bold">Desde:</span></label>
                            <input type="text" id="datepickerSince" name="dateFrom" value="{{Carbon\Carbon::now()->format('Y/m/d')}}" class="bg-white text-center" width="150px" readonly required>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center pt-2 mb-2">
                            <label><span class="me-1 font-weight-bold">Hasta:</span></label>
                            <input type="text" id="datepickerUntil" name="dateTo" value="{{Carbon\Carbon::now()->format('Y/m/d')}}" class="bg-white text-center" width="150px" readonly required>
                        </div>
                            <input type="hidden" name="userRole" id="userRole" value="{{Auth::user()->role}}">
                            <input type="hidden" name="userID" id="userID" value="{{Auth::user()->id}}">
                        <div class="col-md-2 col-xs-12 d-flex justify-content-md-start justify-content-center ps-0">
                            <button id="sendDatesButton" class="btn btn-success bg-gradient">Enviar</button>
                        </div>
                    </div>
                </div>
            @endif
            @hasrole('Administrator')
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. fallidas</p>
                                    <h5 class="font-weight-bolder" id="failedTransactionsTitle">
                                        {{ $failedTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4 ">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. exitosas</p>
                                    <h5 class="font-weight-bolder" id="successTransactionsTitle">
                                        {{ $successfulTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. canceladas</p>
                                    <h5 class="font-weight-bolder" id="cancelTransactionsTitle">
                                        {{ $cancelledTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. en espera</p>
                                    <h5 class="font-weight-bolder" id="holdTransactionsTitle">
                                        {{ $holdTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4 ms-auto">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. aceptadas</p>
                                    <h5 class="font-weight-bolder" id="acceptedTransactionsTitle">
                                        {{ $acceptedTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4 me-auto">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Total Transacciones</p>
                                    <h5 class="font-weight-bolder" id="totalTransactionsTitle">
                                        {{ $transactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 mb-4"></div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Administradores</p>
                                    <h5 class="font-weight-bolder" id="numAdminsTitle">
                                        {{ $administratorCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="material-icons opacity-10">person</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4 ">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Distribuidores</p>
                                    <h5 class="font-weight-bolder" id="numDistributorsTitle">
                                        {{ $distributorCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="material-icons opacity-10">group</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4 ">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Tenderos</p>
                                    <h5 class="font-weight-bolder" id="numShopkeepersTitle">
                                        {{ $shopkeeperCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="material-icons opacity-10">groups</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4 ">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Proveedores</p>
                                    <h5 class="font-weight-bolder" id="numSuppliersTitle">
                                        {{ $supplierCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="material-icons opacity-10">supervisor_account</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Transacciones este mes</p>
                                    <h5 class="font-weight-bolder" id="transactionsPerMonthTitle">{{ $transactionCount }}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">Saldo Tenderos</p>
                                    <h5 class="font-weight-bolder" id="shopkeepersBalanceTitle">${{number_format($shopkeepersBalance, 2, ',', '.')}}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="material-icons opacity-10">payments</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4 ">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">Saldo Proveedores</p>
                                    <h5 class="font-weight-bolder" id="suppliersBalanceTitle">${{number_format($suppliersBalance , 2, ',', '.')}}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="material-icons opacity-10">payments</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4 ">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">Ganancia en red</p>
                                    <h5 class="font-weight-bolder" id="profitTitle">${{number_format($totalProfit , 2, ',', '.')}}</h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="material-icons opacity-10">payments</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endhasrole
            @hasrole('Distributor')
            @endhasrole
            @hasrole('Shopkeeper')
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. fallidas</p>
                                    <h5 class="font-weight-bolder" id="failedTransactionsTitle">
                                        {{ $failedTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. exitosas</p>
                                    <h5 class="font-weight-bolder" id="successTransactionsTitle">
                                        {{ $successfulTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. en espera</p>
                                    <h5 class="font-weight-bolder" id="holdTransactionsTitle">
                                        {{ $holdTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. aceptadas</p>
                                    <h5 class="font-weight-bolder" id="acceptedTransactionsTitle">
                                        {{ $acceptedTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-2 ms-auto">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Total Transacciones</p>
                                    <h5 class="font-weight-bolder" id="totalTransactionsTitle">
                                        {{ $transactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-info text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 mb-4"></div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Transacciones este mes</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $transactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endhasrole
            @hasrole('Supplier')
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. fallidas</p>
                                    <h5 class="font-weight-bolder" id="failedTransactionsTitle">
                                        {{ $failedTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. exitosas</p>
                                    <h5 class="font-weight-bolder" id="successTransactionsTitle">
                                        {{ $successfulTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. en espera</p>
                                    <h5 class="font-weight-bolder" id="holdTransactionsTitle">
                                        {{ $holdTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. aceptadas</p>
                                    <h5 class="font-weight-bolder" id="acceptedTransactionsTitle">
                                        {{ $acceptedTransactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-2 ms-auto">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Total Transacciones</p>
                                    <h5 class="font-weight-bolder" id="totalTransactionsTitle">
                                        {{ $transactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-info text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 mb-4"></div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Transacciones este mes</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $transactionCount }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="material-icons opacity-10">currency_exchange</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endhasrole
            <div class="row mt-4">
                @hasrole('Distributor')
                <div class="col-lg-4 row">
                    <div class="col-lg-12 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Tenderos</p>
                                            <h5 class="font-weight-bolder">
                                                {{ $shopkeeperCount }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                            <i class="material-icons opacity-10">group</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-xs mb-0 text-uppercase font-weight-bold">Saldo Tenderos</p>
                                            <h5 class="font-weight-bolder">
                                                ${{number_format($shopkeepersBalance, 2, ',', '.')}}
                                            </h5>

                                        </div>
                                    </div>
                                    <div class="col-3 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                            <i class="material-icons opacity-10">payments</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endhasrole
                @if (Auth::user()->role !== 'Saldos')
                    <div class="col-lg-3 col-md-6 mt-4 mb-4">
                        <div class="card z-index-2 ">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                @if ((Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Distributor') && isset(Auth::user()->brand_id))
                                    <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                        <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#ExcelModal" onclick="excelURL('Transacciones')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                    </div>
                                @else
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                        <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#ExcelModal" onclick="excelURL('Transacciones')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h6 class="mb-0 ">Estadística 1°</h6>
                                <p class="text-sm ">Transaccíones</p>
                                <hr class="dark horizontal">
                                <div class="d-flex ">
                                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                                    <p class="mb-0 text-sm"> Rango seleccionable </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (Auth::user()->role !== 'Distributor')
                    <div class="col-lg-3 col-md-6 mt-4 mb-4">
                        <div class="card z-index-2  ">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                @if (Auth::user()->role == 'Shopkeeper' && isset(Auth::user()->brand_id))
                                <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                    <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                            data-bs-target="#ExcelModal" onclick="excelURL('Saldos')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                </div>
                                @else
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                        <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                                data-bs-target="#ExcelModal" onclick="excelURL('Saldos')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                    </div>
                                @endif

                            </div>
                            <div class="card-body">
                                <h6 class="mb-0 "> Estadística 2° </h6>
                                <p class="text-sm ">Historial de saldos</p>
                                <hr class="dark horizontal">
                                <div class="d-flex ">
                                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                                    <p class="mb-0 text-sm"> Rango seleccionable </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @hasanyrole('Shopkeeper|Supplier')
                <div class="col-lg-3 col-md-6 mt-4 mb-4">
                    <div class="card z-index-2  ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            @if (Auth::user()->role == 'Shopkeeper' && isset(Auth::user()->brand_id))
                                <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                    <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                            data-bs-target="#ExcelModal" onclick="excelURL('Extracto')"><a><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                </div>
                            @else
                                <div class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                    <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                            data-bs-target="#ExcelModal" onclick="excelURL('Extracto')"><a><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 "> Estadística 3° </h6>
                            <p class="text-sm ">Extracto de saldos</p>
                            <hr class="dark horizontal">
                            <div class="d-flex ">
                                <i class="material-icons text-sm my-auto me-1">schedule</i>
                                <p class="mb-0 text-sm"> Rango seleccionable </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endhasanyrole
                    <div class="col-lg-3 mt-4 mb-3">
                        <div class="card z-index-2 ">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                @if ((Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Distributor') && isset(Auth::user()->brand_id))
                                    <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                        <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                                data-bs-target="#ExcelModal" onclick="excelURL('Ganancias')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                    </div>
                                @else
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                        <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                                data-bs-target="#ExcelModal" onclick="excelURL('Ganancias')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                    </div>
                                @endif

                            </div>
                            <div class="card-body">
                                <h6 class="mb-0 ">Estadística 4°</h6>
                                <p class="text-sm ">Historial de retiro de ganancias</p>
                                <hr class="dark horizontal">
                                <div class="d-flex ">
                                    <i class="material-icons text-sm my-auto me-1">schedule</i>
                                    <p class="mb-0 text-sm"> Rango seleccionable </p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <script type="text/javascript">
                function showCharts()
                {
                    let selectProductChart = document.getElementById('productChart');
                    let containerChart = document.getElementById('container'+selectProductChart.value)
                    let charts = document.querySelectorAll('.product-chart');

                    charts.forEach(function(chart){
                        chart.style.display = 'none';
                    });

                    containerChart.style.display = 'block';
                }
            </script>
            @if (Auth::user()->role == 'Administrator')
                <div class="row">
                    <div class="col-md-12">
                        <select id="productChart" class="form-select mt-6 mb-5 bg-white text-center" aria-label="Default select example" onchange="showCharts()">
                            <option value="">Seleccione un producto</option>
                            @foreach ($auxProducts as $product)
                                <option value="{{$product->id}}">{{$product->product_name}} -
                                    @if ($product->product_type == 'Deposit')
                                        DEPOSITO
                                    @else
                                        RETIRO
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {!! $htmlContainers !!}
                </div>
            @endif
        </div>
        @hasrole('Shopkeeper')
        @if (is_null(Auth::user()->brand_id))
            <div class="row mt-4">
            </div>
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                        <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Publicidad</h6>
                                    </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="container">
                                    <div class="row">
                                        @if (isset($publicity))
                                        @foreach($publicity as $value)
                                            <div class="col-md-3 m-2 ms-auto me-auto d-flex w-20">
                                                <div class="card card-profile p-0 m-0">
                                                    <div class="position-relative">
                                                        <a class="image-link" href="{{getenv('URL_SERVER').$value->publicity_url}}">
                                                            <img src="{{getenv('URL_SERVER').$value->publicity_url}}" alt="Image placeholder" class="card-img-top">
                                                        </a>
                                                    </div>
                                                    <div class="card-body text-center border-0 p-0">
                                                        <div class="d-flex justify-content-center">
                                                            <div class="d-inline">
                                                                <a style="color: darkred;" href="{{route('publicity.download', ['id' => $value->id])}}" title="Descargar" class="btn btn-link px-1 mb-0"><i style="color: darkblue; font-size: 25px !important;" class="material-icons opacity-10">download</i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endhasrole
        @hasanyrole('Supplier|Shopkeeper|Administrator|Distributor')
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            @if (isset(Auth::user()->brand_id))
                                <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                    <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Últimas transacciones</h6>
                                </div>
                            @else
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                    <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Últimas transacciones</h6>
                                </div>
                            @endif
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12"></div>
                                    <div class="table-responsive p-0">
                                        <table id="tabla1" class="table align-items-center mb-0">
                                            <thead class="thead-light">
                                            <tr class="text-center text-uppercase font-weight-bolder">
                                                <th>Cantidad</th>
                                                <th>Tipo</th>
                                                <th>Producto</th>
                                                @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Distributor')
                                                    <th>Tendero</th>
                                                @endif
                                                <th>Estado</th>
                                                <th>Fecha</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($lastTransactions as $transaction)
                                                <tr class="text-center text-uppercase text-secondary">
                                                    <td>${{number_format($transaction->amount, 2, ',', '.')}}</td>
                                                    <td>
                                                        @if ($transaction->type == 'Withdrawal')
                                                            Retiro
                                                        @endif
                                                        @if ($transaction->type == 'Deposit')
                                                            Deposito
                                                        @endif
                                                    </td>
                                                    <td>{{$transaction->product->product_name}}</td>
                                                    @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Distributor')
                                                        <td>{{$transaction->shopkeeper->name}}</td>
                                                    @endif
                                                    <td>
                                                        @if ($transaction->status == 'hold')
                                                            <center>
                                                                <p class="text-center text-dark text-xxs p-1" style="background-color:#f5df4d; width:80%; border-radius: 20px;">En espera</p>
                                                            </center>
                                                        @endif
                                                        @if ($transaction->status == 'accepted')
                                                            <center>
                                                                <p class="text-center text-white text-xxs p-1" style="background-color:dodgerblue; width:80%;  border-radius: 20px;">Aceptada</p>
                                                            </center>
                                                        @endif
                                                        @if ($transaction->status == 'successful')
                                                            <center>
                                                                <p class="text-center text-white text-xxs p-1" style="background-color:green; width:80%; border-radius: 20px;">Exitosa</p>
                                                            </center>
                                                        @endif
                                                        @if ($transaction->status == 'failed')
                                                            <center>
                                                                <p class="text-center text-white text-xxs p-1" style="background-color:red; width:80%; border-radius: 20px;">Fallida</p>
                                                            </center>
                                                        @endif
                                                        @if ($transaction->status == 'cancelled')
                                                            <center>
                                                                <p class="text-center text-white text-xxs p-1" style="background-color:#58696F; width:80%; border-radius: 20px;">Cancelada</p>
                                                            </center>
                                                        @endif
                                                    </td>
                                                    <td>{{$transaction->updated_at}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endhasanyrole
        <script type="text/javascript">
            $(document).ready(function() {
                @if (Auth::user()->role == 'Administrator')
                @for ($i = 0; $i < count($superProduct); $i++)

                var dates2 = {{ str_replace('"', "", json_encode($superProduct[$i][0])) }};

                dates2 = dates2.map(function (num) {
                    if (num == 1) {
                        num = 'Ene'
                    }
                    if (num == 2) {
                        num = 'Feb'
                    }
                    if (num == 3) {
                        num = 'Mar'
                    }
                    if (num == 4) {
                        num = 'Abr'
                    }
                    if (num == 5) {
                        num = 'May'
                    }
                    if (num == 6) {
                        num = 'Jun'
                    }
                    if (num == 7) {
                        num = 'Jul'
                    }
                    if (num == 8) {
                        num = 'Ago'
                    }
                    if (num == 9) {
                        num = 'Sep'
                    }
                    if (num == 10) {
                        num = 'Oct'
                    }
                    if (num == 11) {
                        num = 'Nov'
                    }
                    if (num == 12) {
                        num = 'Dic'
                    }

                    return num
                });

                var productCounts = {{ str_replace('"', "", json_encode($superProduct[$i][2])) }};
                var amounts = {{ str_replace('"', "", json_encode($superProduct[$i][1])) }};

                @if (count($products) < $i)
                Highcharts.chart('container{{$products[$i]}}', {
                    chart: {
                        type: 'area'
                    },
                    title: {
                        text: 'Dinero movido y cantidad de transacciones'
                    },
                    xAxis: {
                        categories: dates2
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de dinero'
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                    },
                    plotOptions: {
                        series: {
                            allowPointSelect: true
                        }
                    },
                    series: [{
                        name: 'Monto',
                        data: amounts
                    },
                        {
                            name: 'Cantidad transacciones',
                            data: productCounts
                        }
                    ]
                });
                @endif
                @endfor
                @endif
            });
        </script>
        <script>
            $(document).ready(function () {
                carousel_next = document.querySelector('.carousel-control-next');
                setInterval(()=>{
                    carousel_next.click();
                }, 3000);
            });

            function excelURL(type) {
                var actionURL = document.getElementById("action");
                var actionURL2 = document.getElementById("actionProductTransactions");
                var divSelectProducts = document.getElementById("div-select-transaction-products");
                var divSelectStatus = document.getElementById("div-select-transaction-status");


                if(type == 'Transacciones'){
                    actionURL.action = "{{ url('/transaction/excel') }}";
                    document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
                    divSelectProducts.style.display = "block";
                    divSelectStatus.style.display = "block";

                }
                if(type == 'Saldos'){
                    actionURL.action = "{{ url('/balance/excel') }}";
                    document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
                    divSelectProducts.style.display = "none";
                    divSelectStatus.style.display = "none";
                }
                if(type == 'Extracto'){
                    actionURL.action = "{{ url('/balanceSummary/excel') }}";
                    document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
                    divSelectProducts.style.display = "none";
                    divSelectStatus.style.display = "none";
                }
                if(type == 'Ganancias'){
                    actionURL.action = "{{ url('/profit/excel') }}";
                    document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
                    divSelectProducts.style.display = "none";
                    divSelectStatus.style.display = "none";
                }
                if(type == 'ProductTransactions'){
                    actionURL2.action = "{{ url('/transaction/excel') }}";
                    document.getElementById("LabelProductTransactions").innerHTML = "Transacciones por producto";
                }
            }
        </script>
        <!-- Modal-->
        <div class="modal fade" id="ExcelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Seleccionar Fecha</h6>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="action" action="{{ url('/transaction/excelff') }}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                @csrf
                                @if(count($errors)>0)
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            @foreach( $errors->all() as $error )
                                                <li> {{ $error }} </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-12" id="div-select-transaction-products">
                                    <div class="form-group">
                                        <label for="product">Seleccione un producto:</label>
                                        <select class="form-select mb-4" name="product_id">
                                            <option value="all">TODOS</option>
                                            @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{strtoupper($product->product_name)}} -
                                                    @if ($product->product_type == 'Deposit')
                                                        DEPOSITO
                                                    @else
                                                        RETIRO
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12" id="div-select-transaction-status">
                                    <div class="form-group">
                                        <label for="product">Seleccione un estado:</label>
                                        <select class="form-select mb-4" name="status" >
                                            <option value="all">TODOS</option>
                                            <option value="successful">EXITOSAS</option>
                                            <option value="failed">FALLIDAS</option>
                                            <option value="cancelled">CANCELADAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Desde</label>
                                        <input type="date" id="dateFrom" name="dateFrom" value="{{ Illuminate\Support\Carbon::now()->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Hasta</label>
                                        <input type="date" id="dateTo" name="dateTo" value="{{ Illuminate\Support\Carbon::now()->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <input class="btn btn-success" type="submit" value="Descargar excel">
                                    @if ((Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Distributor') && isset(Auth::user()->brand_id))
                                        <a style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="btn btn-primary" href="{{ url('/home') }}"> Regresar</a>
                                    @else
                                        <a class="btn btn-primary" href="{{ url('/home') }}"> Regresar</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end Modal-->
        <!--Modal-->
        @if (isset($balancesCount) || isset($profitsCount))
            @if ($balancesCount > 0 || $profitsCount > 0)
                <div class="modal fade" id="BalanceProfitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <div class="row jusfify-content-center align-items-center">
                                            <img width="60%" class="img-responsive" src="{{$urlServer}}/assets/img/bell.png">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-8">
                                        <div class="row jusfify-content-center align-items-center">
                                            <div class="col-md-12">
                                                <h2 class="text-center pe-2">¡Tienes una nueva solicitud de saldo y/o retiro de ganancia!</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ms-auto me-auto">
                                        <div class="col-md-6 col-sm-6 mt-3 ms-auto me-auto">
                                            <a id="btn-balance" class="btn btn-success bg-gradient ms-auto me-auto w-100" href="/balance">Ir a saldos</a>
                                        </div>
                                    </div>
                                    <div class="row ms-auto me-auto clearfix">
                                        <div class="col-md-6 col-sm-6 ms-auto me-auto mt-2">
                                            <a id="btn-profit" class="btn btn-success bg-gradient ms-auto w-100" href="/profit/users">Ir a ganancias</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
    @endif
    <!--end Modal-->
        <!--Modal-->
        <div class="modal fade" id="qrDisabledAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true" data-bs-show="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div style="overflow-y: auto; height: 80vh;" class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="d-flex justify-content-center">
                                    <img width="30%" class="img-responsive" src="{{$urlServer}}/assets/img/danger_icon.png">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mt-3">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-12">
                                        <p style="font-size:20px; font-family:monospace;" class="text-center pe-2">Yo, {{strtoupper(Auth::user()->name)}}, declaro que he decidido deshabilitar voluntariamente el sistema de seguridad QR que me ofrecía el proveedor
                                            {{(isset(Auth::user()->distributor->brand)) ? Auth::user()->distributor->brand->domain : 'asparecargas.net'}}.
                                            Reconozco que este sistema de seguridad QR me brindaba una mayor protección contra el fraude, el robo de identidad y otras amenazas cibernéticas.
                                            Al deshabilitar este sistema de seguridad QR, asumo la responsabilidad de cualquier daño o pérdida que pueda sufrir como consecuencia de esta decisión.
                                            También libero al proveedor de cualquier responsabilidad civil, penal o administrativa que pueda derivarse de mi deshabilitación del sistema de seguridad QR.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 mt-3 d-flex justify-content-center">
                                <button class="btn btn-success bg-gradient" data-bs-dismiss="modal">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal-->

        <audio id="alert" style="display: none;" src="/assets/alerts/SD_ALERT_3.mp3"
               controls>
            Your browser does not support the <code>audio</code> element.
        </audio>
        <input type="button" style="display:none" id="btn" value="reproducir">
        <input type="button" style="display:none" id="btn2" value="reproducir">
        <input type="button" style="display:none" id="btn-modal" value="reproducir">
        <input type="button" style="display:none" id="btn-modal2" value="reproducir">
        <script type="text/javascript">
            window.addEventListener("load", function(event) {
                @if (isset($balancesCount) || isset($profitsCount))
                let alert = document.getElementById('alert');
                let btn = document.getElementById('btn');
                let btnModal = document.getElementById('btn-modal');
                let btnBalance = document.getElementById('btn-balance');
                let btnProfit = document.getElementById('btn-profit');

                setTimeout("location.reload()", 30000);
                @if ($balancesCount > 0)
                    btnBalance.style.display = "block";
                @else
                    btnBalance.style.display = "none";
                @endif
                    @if ($profitsCount > 0)
                    btnProfit.style.display = "block";
                @else
                    btnProfit.style.display = "none";
                @endif
                $("#btn").on('click', function(){
                    alert.play();
                })
                $("#btn-modal").on('click', function(){
                    $('#BalanceProfitModal').modal('show');
                })
                btn.click()
                btnModal.click()
                $('[data-slide-to=0]').trigger('click')
                @endif
                @if (! is_null($showQRDisabledAlert))
                $('#qrDisabledAlert').modal('toggle');
                @endif
            });
        </script>
        <script type="text/javascript">
            $('#sendDatesButton').click(function(){
                var data = {
                    dateFrom: $('#datepickerSince').val(),
                    dateTo: $('#datepickerUntil').val(),
                    userRole: $('#userRole').val(),
                    userID: $('#userID').val()
                }
                $.ajax({
                    type: 'POST',
                    data: data,
                    url: '{{getenv('APP_URL')}}/api/get-statistics-data',
                    success: function(response) {
                        $('#failedTransactionsTitle').text(response.data.attributes.failedTransactions);
                        $('#successTransactionsTitle').text(response.data.attributes.successTransactions);
                        @if (Auth::user()->role == 'Administrator')
                        $('#cancelTransactionsTitle').text(response.data.attributes.cancelledTransactions);
                        @endif
                        $('#holdTransactionsTitle').text(response.data.attributes.holdTransactions);
                        $('#acceptedTransactionsTitle').text(response.data.attributes.acceptedTransactions);
                        let totalTransactions = parseInt(response.data.attributes.failedTransactions) +
                            parseInt(response.data.attributes.successTransactions) +
                            parseInt(response.data.attributes.cancelledTransactions) +
                            parseInt(response.data.attributes.holdTransactions) +
                            parseInt(response.data.attributes.acceptedTransactions);
                        $('#totalTransactionsTitle').text(String(totalTransactions));
                    }
                })
            });
        </script>
@endsection
