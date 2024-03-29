@extends('layouts.dashboard')
@section('content')
    @if(Session::has('existingProfit'))
        <div class="alert alert-danger text-white d-flex justify-content-center" role="alert">
            {{ Session::get('existingProfit') }}
        </div>
    @endif
    @if(Session::has('limitExceeded'))
        <div class="alert alert-danger text-white d-flex justify-content-center" role="alert">
            {{ Session::get('limitExceeded') }}
        </div>
    @endif
    @if(Session::has('noAmount'))
        <div class="alert alert-danger text-white d-flex justify-content-center" role="alert">
            {{ Session::get('noAmount') }}
        </div>
    @endif
    <div class="row mt-4"></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        @if ((Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Distributor') && isset(Auth::user()->brand_id))
                            <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Retirar Ganancias</h6>
                            </div>
                        @else
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Retirar Ganancias</h6>
                            </div>
                        @endif
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
                                        <input type="text" class="form-control" name="amount" value="" id="amount" oninput="formatNumber('amount')" placeholder="">
                                    </div>
                                </div>
                                  @if (Auth::user()->role == 'Supplier' || Auth::user()->role == 'Distributor'
                                  || Auth::user()->role == 'Shopkeeper')
                                <div class="col-md-4">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="transactionNumber" id="account_label" class="form-label">Numero de Cuenta</label>
                                        <input type="text" class="form-control" name="accountNumber" value="" id="acountNumber" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="entity" class="form-label">Entidad bancaria</label>
                                        <input type="text" class="form-control" name="entity" value="" id="entity" placeholder="">
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-4"></div>

                                  <div class="text-center">
                                      @if ((Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Distributor') && isset(Auth::user()->brand_id))
                                          <input style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="btn btn-primary" type="submit" value="Enviar solicitud">
                                      @else
                                          <input class="btn btn-primary" type="submit" value="Enviar solicitud">
                                      @endif
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
