@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="{{ route('banners.create') }}" class="btn btn-block"></a>Top tenderos</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="{{route('shopkeeper.top')}}" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Seleccione un año:</label>
                                            <select class="form-control text-center" name="year">
                                                @foreach($years as $year)
                                                    <option value="{{$year}}">{{$year}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Seleccione un mes:</label>
                                            <select class="form-control text-center" name="month">
                                                <option value="01">Enero</option>
                                                <option value="02">Febrero</option>
                                                <option value="03">Marzo</option>
                                                <option value="04">Abril</option>
                                                <option value="05">Mayo</option>
                                                <option value="06">Junio</option>
                                                <option value="07">Julio</option>
                                                <option value="08">Agosto</option>
                                                <option value="09">Septiembre</option>
                                                <option value="10">Octubre</option>
                                                <option value="11">Noviembre</option>
                                                <option value="12">Diciembre</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success bg-gradient m-4 float-end" value="Ver tenderos">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
