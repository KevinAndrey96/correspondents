@extends('layouts.dashboard')
@section('content')
    @if(Session::has('deniedAccess'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('deniedAccess') }}
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
        @hasrole('Administrator')
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">payments</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Saldo Tenderos</p>
                            <h4 class="mb-0">$ {{ $shopkeepersBalance }}</h4>
                            <p class="text-sm mb-0 text-capitalize">Saldo Proveedores</p>
                            <h4 class="mb-0">$ {{ $suppliersBalance }}</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1"></div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">send</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">N° Transacciones</p>
                            <h4 class="mb-0">{{ $transactionCount }}</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">send</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">N° Transacciones fallidas</p>
                            <h4 class="mb-0">{{ $failedTransactionCount }}</h4>
                            <p class="text-sm mb-0 text-capitalize">N° Transacciones exitosas</p>
                            <h4 class="mb-0">{{ $successfulTransactionCount }}</h4>
                            <p class="text-sm mb-0 text-capitalize">N° Transacciones en espera</p>
                            <h4 class="mb-0">{{ $holdTransactionCount }}</h4>
                            <p class="text-sm mb-0 text-capitalize">N° Transacciones aceptadas</p>
                            <h4 class="mb-0">{{ $acceptedTransactionCount }}</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">group</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">N° Administradores</p>
                            <h4 class="mb-0">{{ $administratorCount }}</h4>
                            <p class="text-sm mb-0 text-capitalize">N° Tenderos</p>
                            <h4 class="mb-0">{{ $shopkeeperCount }}</h4>
                            <p class="text-sm mb-0 text-capitalize">N° Proveedores</p>
                            <h4 class="mb-0">{{ $supplierCount }}</h4>
                            <p class="text-sm mb-0 text-capitalize">N° Distribuidores</p>
                            <h4 class="mb-0">{{ $distributorCount }}</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                    </div>
                </div>
            </div>
        @endhasrole
        </div>

@endsection
