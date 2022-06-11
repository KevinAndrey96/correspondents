@extends('layouts.dashboard')
@section('content')

    <div class="row mt-6">
        @if(Session::has('messageSuccess'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('messageSuccess') }}
            </div>
        @endif
        @if(Session::has('failChange'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('failChange') }}
            </div>
        @endif
        @if(Session::has('unfulfilledRequirements'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('unfulfilledRequirements') }}
            </div>
        @endif
    </div>

    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <h5 class="text-white font-weight-bolder text-center mt-2 mb-2">Cambiar contraseña</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/updatePassword">
                              @csrf
                                <div >
                                    <div class="input-group input-group-dynamic mb-4">
                                        <label class="form-label" for="oldPass">Contraseña antigua</label>
                                        <input type="password" class="form-control" name="oldPass" placeholder="" required>
                                    </div>
                                </div>
                                <div >
                                    <div class="input-group input-group-dynamic mb-4">
                                        <label class="form-label" for="newPass1">Contraseña nueva</label>
                                        <input type="password" class="form-control" name="newPass1" placeholder="" required>
                                    </div>
                                </div>
                                <div >
                                    <div class="input-group input-group-dynamic mb-4">
                                        <label class="form-label" for="newPass2">Confirmar contraseña</label>
                                        <input type="password" class="form-control" name="newPass2" placeholder="" required>
                                    </div>
                                </div>
                                <div class="text-center"><input type="submit" class="btn btn-primary text-center" value="Modificar"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-8">
    </div>

@endsection


