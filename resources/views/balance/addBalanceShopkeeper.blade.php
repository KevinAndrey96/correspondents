@extends('layouts.dashboard')
@section('content')
    <div class="row "></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Recargar saldo</h6>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form action="{{ url('/balance/store') }}" method="post" enctype="multipart/form-data">
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
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="amount" class="form-label"></label>
                                        <input type="number" class="form-control" name="amount" value="" id="amount" step="10000" min="20000.0" placeholder="Monto">
                                    </div>
                                </div>
                                <!--<div class="col-md-6">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="transactionNumber" id="account_label" class="form-label"></label>
                                        <input type="text" class="form-control" name="transactionNumber" value="" id="transactionNumber" placeholder="Numero de Transacción">
                                    </div>
                                </div>-->
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                     <div class="p-3">
                                      <label for="image" id="image_label" class="form-label">Recibo</label>
                                      @if(isset($balance->boucher))
                                          <img class="img-thumbnail img-fluid" src="{{ 'https://corresponsales.asparecargas.net/'.$balance->boucher }}" width="100" alt = "No carga">
                                      @endif
                                      <input style="border: gray 0.5px solid; border-radius: 20px" class="form-control form-control-sm" type="file" id="image" name="image">
                                     </div>
                                </div>
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
    <div class="container-fluid py-0 mb-3">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <div class="bg-gradient-primary shadow-primary border-radius-lg py-6 pe-1">
                <p class="text-center text-white text-xl">Banner con cuentas autorizadas</p>
            </div>
        </div>
    </div>

@endsection
