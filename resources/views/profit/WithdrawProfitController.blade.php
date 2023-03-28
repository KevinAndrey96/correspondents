@extends('layouts.dashboard')
@section('content')
    @if(Session::has('existingProfit'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('existingProfit') }}
        </div>
    @endif
    @if(Session::has('limitExceeded'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('limitExceeded') }}
        </div>
    @endif
    <div class="row mt-4"></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Retirar Ganancias</h6>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form action="{{ url('/profit/store') }}" method="post" enctype="multipart/form-data" onsubmit="return confirm('¿Está seguro que desea realizar esta solicitud?');">
                              <div class="row">
                                @csrf
                                @if(count($errors)>0)
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                        @foreach( $errors->all() as $error )
                                                <li><p class="text-center text-sm text-white"> {{ $error }}</p> </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="amount" class="form-label">Monto</label>
                                        <input type="number" class="form-control" name="amount" value="" id="amount" step="any" min="0" placeholder="">
                                    </div>
                                </div>
                                @hasanyrole('Supplier|Distributor|Shopkeeper')
                                <div class="col-md-4">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="transactionNumber" id="account_label" class="form-label">Numero de Cuenta</label>
                                        <input type="text" class="form-control" name="acountNumber" value="" id="acountNumber" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class=" input-group input-group-outline my-3">
                                        <select class="form-select" name="entity" id="entity">
                                            <option selected disabled>Seleccione una entidad</option>
                                            @foreach ($products as $product)
                                                <option value="{{$product->id}},{{$product->product_name}}">{{strtoupper($product->product_name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endhasanyrole
                                <div class="col-md-4"></div>

                                  <div class="text-center">
                                      <input class="btn btn-primary" type="submit" value="Enviar solicitud">

                                      <a style="background-color: gray" class="btn text-white" href="{{ url('/home') }}"> Regresar</a>
                                  </div>

                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
