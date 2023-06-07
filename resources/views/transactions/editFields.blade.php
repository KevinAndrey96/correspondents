@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href=""
                                                                                              class="btn btn-block"><i style="color: white; margin-top: 13px;"
                                                                                                                       class="material-icons opacity-10">keyboard_return</i></a>Editar campos de producto</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form action="{{route('transactions.fields-store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="productName" class="form-label">Cuenta</label>
                                            <input type="text" class="form-control" name="account" value="{{$transactionFields->account}}" id="account" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="productName"  class="form-label">Télefono</label>
                                            <input type="text" class="form-control" name="phone" value="{{$transactionFields->phone}}" id="phone" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-outline my-3">
                                            <label for="productCommission" class="form-label">Documento</label>
                                            <input type="text" class="form-control" name="document" value="{{$transactionFields->document}}" id="document" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-outline my-3">
                                            <label for="com_dis" class="form-label">Código</label>
                                            <input type="text" class="form-control" name="code" value="{{$transactionFields->code}}" id="code" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <input type="submit" class="btn btn-success bg-gradient" value="Guardar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
