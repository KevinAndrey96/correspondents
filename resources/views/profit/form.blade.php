@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-3 pb-2">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a>{{ $mode }} Ganancia </a></h6>
                        </div>
                    </div>
                    <div class="card-body px-2 pb-2">
                      <div class="container">
                        @if(count($errors)>0)
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach( $errors->all() as $error )
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                          <form>
                            <div class="row">

                              @if($mode=="Crear")
                                 <div class="col-md-6">
                                  <div class="input-group input-group-outline my-3">
                                      <label for="userID" class="form-label"></label>
                                      <input type="hidden" class="form-control" name="userID" value="{{$userID}}" id="userID" readonly="readonly">
                                  </div>
                                 </div>
                                 <div class="col-md-6">
                                  <div class="input-group input-group-outline my-3">
                                      <label for="profitAmount" class="form-label">Ganancia inicial</label>
                                      <input type="number" class="form-control" name="profitAmount" value="{{ isset($profit->profit_amount)?$profit->profit_amount:old('profit_amount') }}" id="profitAmount" step="1" min="0.0" placeholder="">
                                  </div>
                                 </div>
                              @endif
                              @if($mode=="Editar")
                                  <div class="col-md-10">
                                      <div class="form-group">
                                          <label for="profitAmount" class="form-label"> Cantidad a retirar </label>
                                          <input type="number" class="form-control" name="profitAmount" value="{{ isset($profit->profit_amount)?$profit->profit_amount:old('profit_amount') }}" id="profitAmount" step="1" min="0.0" placeholder="">
                                      </div>
                                  </div>
                              @endif
                              <div class="text-center">
                              <input class="btn btn-primary" type="submit" value="{{ $mode }} datos">

                              <a class="btn btn-info" href="{{ url('/profit') }}"> Regresar</a>
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
