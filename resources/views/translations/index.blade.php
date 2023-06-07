@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Traducciones</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <div class="row mb-4">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <a class="btn btn-success mt-auto mb-auto" href="{{route('product.fields')}}">Productos</a>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center">
                                    <a class="btn btn-success mt-auto mb-auto" href="{{route('transactions.fields')}}">Transacciones</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


