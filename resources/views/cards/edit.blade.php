@extends('layouts.dashboard')
@section('content')
    @if(count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    @if ($error == 'El campo card i m g debe ser un archivo de tipo: jpg, jpeg, png.')
                        <li class="text-white">Formato inválido, los únicos formatos aceptados son: jpg, jpeg, png.</li>
                    @endif
                    @if ($error == 'El campo card p d f debe ser un archivo de tipo: pdf.')
                        <li class="text-white">Formato inválido, el unico formato aceptado es: pdf</li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="{{ route('banners.create') }}" class="btn btn-block"></a>Crear Tarjeta</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="{{route('cards.update')}}" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6 mb-5">
                                        <label for="cardIMG" >Seleccione una imagen con la tarjeta:</label>
                                        <input style="border: gray 0.5px solid; border-radius: 20px" type="file" class="form-control form-control-sm" name="cardIMG" value="" id="cardIMG">
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <label for="cardIMG" >Seleccione una imagen con el QR:</label>
                                        <input style="border: gray 0.5px solid; border-radius: 20px" type="file" class="form-control form-control-sm" name="qrIMG" value="" id="qrIMG">
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <label for="cardPDF" >Seleccione un pdf con la tarjeta:</label>
                                        <input style="border: gray 0.5px solid; border-radius: 20px" type="file" class="form-control form-control-sm" name="cardPDF" value="" id="cardPDF">
                                    </div>
                                    <div class="col-md-6 mt-4 mb-5">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Banco</label>
                                            <input id="bank" type="text" class="form-control" name="bank" value="{{$card->bank}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-4 mb-5">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Monto mínimo</label>
                                            <input id="minAmount" type="number" class="form-control" step="0.1" name="minAmount" min="0" value="{{$card->min_amount}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-4 mb-5">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Penalidad</label>
                                            <input id="penalty" type="number" class="form-control" step="0.1" name="penalty" min="0" value="{{$card->penalty}}">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="cardID" value="{{$card->id}}">
                                <input type="submit" class="btn btn-success bg-gradient m-4 float-end" value="Modificar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
