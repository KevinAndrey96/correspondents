@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 ">
                                <a href="/balance-all" class="btn btn-block">
                                    <i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i>
                                </a>Asignar Saldo</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="{{route('balance.store-assignment')}}" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    @foreach($suppliers as $supplier)
                                        <div class="col-md-4 form-check mt-4">
                                            <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="supplier_id" id="supplier_id" value="{{$supplier->id}}" >
                                                <label class="form-check-label" for="supplier_id">
                                                    {{strtoupper($supplier->name)}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="balance_id" value="{{$balanceID}}">
                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-success bg-gradient m-4" value="Asignar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
