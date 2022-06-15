@extends('layouts.dashboard')
@section('content')
    <div class="row mt-4"></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Seleccione un usuario</h6>

                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <div class="row">
                            @if (Auth::user()->role == 'Administrator')
                                    <div class="col-md-2"></div>
                            <div class="col-md-4 text-center">
                                <button style="background-color: coral" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Distribuidores
                                </button>

                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        @foreach ($users as $user)
                                            @if($user->role == 'Distributor')
                                                <ul class="list-unstyled text-start">
                                                    <ul>
                                                        <li><a class="text-sm" href="/commissions/create/{{$user->id}}">{{$user->name}}</a></li>
                                                    </ul>
                                                </ul>

                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <button style="background-color: orangered" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                                    Proveedores
                                </button>

                                <div class="collapse" id="collapseExample1">
                                    <div class="card card-body">
                                        @foreach ($users as $user)
                                            @if($user->role == 'Supplier')
                                                <ul class="list-unstyled text-start">
                                                    <ul>
                                                        <li><a class="text-sm" href="/commissions/create/{{$user->id}}">{{$user->name}}</a></li>
                                                    </ul>
                                                </ul>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                           @if (Auth::user()->role == 'Distributor')
                            <div class="col-md-4 text-center">
                                <button style="background-color: orangered" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                                        Tenderos
                                </button>
                                <div class="collapse" id="collapseExample2">
                                    <div class="card card-body">
                                        @foreach ($users as $user)
                                            @if ($user->role == 'Shopkeeper')
                                                <ul class="list-unstyled text-start">
                                                    <ul>
                                                        <li><a class="text-sm" href="/commissions/create/{{$user->id}}">{{$user->name}}</a></li>
                                                    </ul>
                                                </ul>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
