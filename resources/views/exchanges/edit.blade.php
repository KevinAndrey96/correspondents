@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="{{ route('exchanges.index') }}" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a> Editar tasa</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="{{route('exchanges.update')}}" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="badge" class="form-label"></label>
                                            <input type="text" class="form-control" name="badge" value="{{$exchange->badge}}" placeholder="Divisa" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="badge" class="form-label"></label>
                                            <input type="number" class="form-control" name="value" value="{{$exchange->value}}" step="any" placeholder="valor" min="0" required>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="exchangeID" value="{{$exchange->id}}">
                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-success bg-gradient m-4" value="Modificar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

