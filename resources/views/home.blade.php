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
                                        @if ($countryName == 'COLOMBIA')
                                            <img class="d-block w-100 rounded img-fluid" src="https://corresponsales.asparecargas.net{{$banner->banner_url}}">
                                        @endif
                                            @if ($countryName == 'ECUADOR')
                                                <img class="d-block w-100 rounded img-fluid" src="https://transacciones.asparecargas.net{{$banner->banner_url}}">
                                            @endif
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        @if ($countryName == 'COLOMBIA')
                                            <img class="d-block w-100 rounded img-fluid" src="https://corresponsales.asparecargas.net{{$banner->banner_url}}">
                                        @endif
                                            @if ($countryName == 'ECUADOR')
                                                <img class="d-block w-100 rounded img-fluid" src="https://transacciones.asparecargas.net{{$banner->banner_url}}">
                                            @endif
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @else
                        <div class="carousel-item active">
                            @if ($countryName == 'COLOMBIA')
                                <img class="d-block w-100 rounded img-fluid" src="https://corresponsales.asparecargas.net/assets/img/Banner/banner_original.png">
                            @endif
                                @if ($countryName == 'ECUADOR')
                                    <img class="d-block w-100 rounded img-fluid" src="https://transacciones.asparecargas.net/assets/img/Banner/banner_original.png">
                                @endif
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
            @hasrole('Administrator')
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. fallidas</p>
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4 ">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. en espera</p>
                                    <h5 class="font-weight-bolder">
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
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4 ">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. aceptadas</p>
                                    <h5 class="font-weight-bolder">
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
            <div class="col-xl-3 col-sm-2 mb-xl-2 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Administradores</p>
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">{{ $transactionCount }}</h5>
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
                                    <h5 class="font-weight-bolder">${{number_format($shopkeepersBalance, 2, ',', '.')}}</h5>
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
                                    <h5 class="font-weight-bolder">${{number_format($suppliersBalance , 2, ',', '.')}}</h5>
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
                                    <h5 class="font-weight-bolder">${{number_format($totalProfit , 2, ',', '.')}}</h5>
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
        <!-- <div  class="col-lg-3 col-sm-6 mb-xl-0 mb-4"></div>
            <div style="margin-left: -14px;" class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">Saldo Tenderos</p>
                                    <h5 class="font-weight-bolder text-xs">
                                        ${{ $shopkeepersBalance }}
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
<div class="col-lg-3 col-sm-6 mb-xl-0 mb-4">
<div class="card">
<div class="card-body p-3">
<div class="row">
    <div class="col-8">
        <div class="numbers">
            <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Tenderos</p>
            <h5 class="font-weight-bolder text-xs">
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
</div> -->
            @endhasrole
            @hasrole('Shopkeeper')
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
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. fallidas</p>
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
            @endhasrole
            @hasrole('Supplier')
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
            <div class="col-xl-2 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-xs mb-0 text-uppercase font-weight-bold">N° Trans. fallidas</p>
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
                                    <h5 class="font-weight-bolder">
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
                                <div class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                    <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#ExcelModal" onclick="excelURL('Transacciones')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                </div>
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

                @if (Auth::user()->role !== 'Distributor' && Auth::user()->role !== 'Saldos')
                    <div class="col-lg-3 col-md-6 mt-4 mb-4">
                        <div class="card z-index-2  ">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                    <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                            data-bs-target="#ExcelModal" onclick="excelURL('Saldos')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                </div>
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
                            <div class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                        data-bs-target="#ExcelModal" onclick="excelURL('Extracto')"><a><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                            </div>
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
                @if (Auth::user()->role !== 'Saldos')
                    <div class="col-lg-3 mt-4 mb-3">
                        <div class="card z-index-2 ">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                    <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                            data-bs-target="#ExcelModal" onclick="excelURL('Ganancias')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                </div>
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
                @endif
                @if (Auth::user()->role == 'Shopkeeper')
                    <div class="col-lg-3 mt-4 mb-3">
                        <div class="card z-index-2 ">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                    <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                            data-bs-target="#ExcelProductTransactionsModal"  onclick="excelURL('ProductTransactions')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="mb-0 ">Estadística 5°</h6>
                                <p class="text-sm ">Transacciones por producto</p>
                                <hr class="dark horizontal">
                            </div>
                        </div>
                    </div>
                @endif
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
        <script type="text/javascript">
            @if (Auth::user()->role == 'Administrator')
            @for ($i = 0; $i < count($superProduct); $i++)
            var dates2 = {{ str_replace('"', "", json_encode($superProduct[$i][0])) }}

                dates2 = dates2.map(function(num){
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

            var amounts = {{ str_replace('"', "", json_encode($superProduct[$i][1])); }}
            Highcharts.chart('container{{$products[$i]}}', {
                chart: {
                    type: 'area'
                },
                title: {
                    text: 'Dinero movido'
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
                }]
            });
            @endfor
            @endif
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

                if(type == 'Transacciones'){
                    actionURL.action = "{{ url('/transaction/excel') }}";
                    document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
                }
                if(type == 'Saldos'){
                    actionURL.action = "{{ url('/balance/excel') }}";
                    document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
                }
                if(type == 'Extracto'){
                    actionURL.action = "{{ url('/balanceSummary/excel') }}";
                    document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
                }
                if(type == 'Ganancias'){
                    actionURL.action = "{{ url('/profit/excel') }}";
                    document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
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
                                <div class="col-md-6">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Desde</label>
                                        <input type="date" id="dateFrom" name="dateFrom">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-static mb-4">
                                        <label>Hasta</label>
                                        <input type="date" id="dateTo" name="dateTo">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <input class="btn btn-success" type="submit" value="Descargar excel">
                                    <a class="btn btn-primary" href="{{ url('/home') }}"> Regresar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end Modal-->
        <!-- Modal-->
        @if (Auth::user()->role == 'Shopkeeper')
            <div class="modal fade" id="ExcelProductTransactionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="LabelProductTransactions"></h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="actionProductTransactions" action="{{ url('/transaction/excelff') }}" method="post" enctype="multipart/form-data">
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="product">Seleccione un producto</label>
                                            <select class="form-select mb-4" name="product_id" >
                                                @foreach ($products as $product)
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
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="input-group date mb-4">
                                            <label>Desde: </label>
                                            <input type="date" class="form-control ms-2" id="dateFrom" name="dateFrom" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="input-group date mb-4">
                                            <label>Hasta: </label>
                                            <input type="date" class="form-control ms-2" id="dateTo" name="dateTo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <input class="btn btn-success" type="submit" value="Descargar excel">
                                        <a class="btn btn-primary" href="{{ url('/home') }}"> Regresar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    <!--end Modal-->
        <!--Modal-->
        @if (isset($balancesCount) || isset($profitsCount))
            @if ($balancesCount > 0 || $profitsCount > 0)
                <div class="modal fade" id="BalanceProfitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!--<h6 class="modal-title" id="exampleModalLabel">Gestionar ganancias</h6>-->
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <div class="row jusfify-content-center align-items-center">
                                            @if ($countryName == 'COLOMBIA')
                                                <img width="60%" class="img-responsive" src="https://corresponsales.asparecargas.net/assets/img/bell.png">
                                            @endif
                                                @if ($countryName == 'ECUADOR')
                                                    <img width="60%" class="img-responsive" src="https://transacciones.asparecargas.net/assets/img/bell.png">
                                                @endif
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

        <audio id="alert" style="display: none;" src="/assets/alerts/SD_ALERT_3.mp3"
               controls>
            Your browser does not support the <code>audio</code> element.
        </audio>
        <input type="button" style="display:none" id="btn" value="reproducir">
        <input type="button" style="display:none" id="btn2" value="reproducir">
        <input type="button" style="display:none" id="btn-modal" value="reproducir">
        <input type="button" style="display:none" id="btn-modal2" value="reproducir">
        <script>
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
            });
        </script>
@endsection
