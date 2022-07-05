@extends('layouts.dashboard')
@section('content')
    @if(Session::has('deniedAccess'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('deniedAccess') }}
        </div>
    @endif
    @hasrole('Administrator')
    <div class="container-fluid py-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <img src="/assets/img/Banner/administrator.png" width="100%" height="auto" class="border-radius-lg">
        </div>
    </div>
    @endhasrole
    @hasrole('Distributor')
    <div class="container-fluid py-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <img src="/assets/img/Banner/distributor.png" width="100%" height="auto" class="border-radius-lg">
        </div>
    </div>
    @endhasrole
    @hasrole('Shopkeeper')
    <div class="container-fluid py-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <img src="/assets/img/Banner/shopkeeper.png" width="100%" height="auto" class="border-radius-lg">
        </div>
    </div>
    @endhasrole
    @hasrole('Supplier')
    <div class="container-fluid py-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <img src="/assets/img/Banner/supplier.png" width="100%" height="auto" class="border-radius-lg">
        </div>
    </div>
    @endhasrole
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
                                    <h5 class="font-weight-bolder">${{ $shopkeepersBalance }}</h5>
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
                                    <h5 class="font-weight-bolder">${{ $suppliersBalance }}</h5>
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
                    </div>
                    <div class="col-lg-12 col-sm-6 mb-xl-0 mb-4">
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
                </div>
                @endhasrole
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
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
                @unlessrole('Distributor')
                <div class="col-lg-4 col-md-6 mt-4 mb-4">
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
                @endunlessrole
                <div class="col-lg-4 mt-4 mb-3">
                    <div class="card z-index-2 ">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg text-center">
                                <button style="margin-top: 2px; margin-bottom: -2px;" type="button" class="btn text-white" data-bs-toggle="modal"
                                data-bs-target="#ExcelModal" onclick="excelURL('Ganancias')"><a ><i class="material-icons opacity-10 ">download</i> Excel</a></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-0 ">Estadística 3°</h6>
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

        </div>
        <script>
        function excelURL(type) {
            var actionURL = document.getElementById("action");
            if(type == 'Transacciones'){
                actionURL.action = "{{ url('/transaction/excel') }}";
                document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
            }
            if(type == 'Saldos'){
                actionURL.action = "{{ url('/balance/excel') }}";
                document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
            }
            if(type == 'Ganancias'){
                actionURL.action = "{{ url('/profit/excel') }}";
                document.getElementById("exampleModalLabel").innerHTML = "("+type+") Seleccionar Fecha";
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
@endsection
