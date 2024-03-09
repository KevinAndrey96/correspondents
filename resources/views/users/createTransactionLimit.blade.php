@extends('layouts.dashboard')
@section('content')
    @if(Session::has('successTransactionLimitsDelete'))
        <div class="alert alert-success" role="alert">
            <p class="text-center text-white">{{ Session::get('successTransactionLimitsDelete') }}</p>
        </div>
    @endif
    @if(Session::has('successTransactionLimitsAssigment'))
        <div class="alert alert-success" role="alert">
            <p class="text-center text-white">{{ Session::get('successTransactionLimitsAssigment') }}</p>
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="/users?role=allShopkeepers" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a>Asignar límites de monto de transacción para {{$userName}}</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="{{route('users.store-transaction-limits')}}" enctype="multipart/form-data">
                                <div class="row justify-content-center">
                                    @csrf
                                    <div class="col-md-12">
                                        <p style="font-size: 20px;" class="font-weight-bold text-center mt-3 mb-6">Límites de monto de transacción por producto</p>
                                        <div class="row">
                                            @foreach ($userTransactionLimits as $value)
                                                <div class="col-md-3 mb-4">
                                                    <div class="w-100 border border-3 border-primary">
                                                        <p class="text-center text-uppercase font-weight-bold">{{$value->product->product_name}}</p>
                                                        <p class="text-center text-uppercase">Monto mínimo: ${{number_format($value->lower_limit, 2, ',', '.')}}</p>
                                                        <p class="text-center text-uppercase">Monto máximo: ${{number_format($value->upper_limit, 2, ',', '.')}}</p>
                                                        <hr class="bg-primary">
                                                        <p class="text-center"><a style="color: darkred;"
                                                                                  href="{{route('users.delete-transaction-limits', ['id' => $value->id])}}"
                                                                                  title="Eliminar" onclick="return confirm('¿Está seguro que desea eliminar estos límites de transacción?');" class="btn btn-link py-0 mb-0">
                                                                <i style="color: darkred; font-size: 25px !important;" class="material-icons opacity-10">delete</i></a></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    <p style="font-size: 20px;" class="font-weight-bold text-center mt-3 mb-2">Asignar límites de monto de transacción</p>
                                    <div class="col-md-8 mt-5 mb-3">
                                        <div class="form-group my-3">
                                            <select class="form-select border" name="productID" id="card_id" required>
                                                <option class="text-center font-weight-bold" selected disabled>Seleccione un producto</option>
                                                @foreach ($products as $product)
                                                    <option class="text-center" value="{{$product->id}}">{{strtoupper($product->product_name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-4 mb-5">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Monto mínimo</label>
                                            <input id="minAmount" type="number" class="form-control" step="0.1" name="lowerLimit" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-4 mb-5">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Monto máximo</label>
                                            <input id="penalty" type="number" class="form-control" step="0.1" name="upperLimit" min="0" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="userID" value="{{$userID}}">
                                <div class="d-flex justify-content-center mb-5">
                                    <input type="submit" class="btn btn-success bg-gradient m-4 float-end" value="Asignar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

