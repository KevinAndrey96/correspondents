@extends('layouts.dashboard')
@section('content')
    <div class="row mt-6">
    </div>

    <div class="container my-auto">
        <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        @if (Auth::user()->role == 'Shopkeeper' && isset(Auth::user()->brand_id))
                            <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h5 class="text-white font-weight-bolder text-center mt-2 mb-2">Contraseña de hoy</h5>
                            </div>
                        @else
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                <h5 class="text-white font-weight-bolder text-center mt-2 mb-2">Contraseña de hoy</h5>
                            </div>
                        @endif
                        <div class="card-body">
                            @if(Session::has('passFail'))
                                <div class="alert alert-danger" role="alert">
                                    <p class="text-center text-white">
                                        {{ Session::get('passFail') }}
                                    </p>
                                </div>
                            @endif
                            <form method="POST" action="{{route('users.store.required.daily.password')}}">
                                @csrf
                                <div>
                                    <div class="input-group input-group-dynamic mb-4">
                                        <label class="form-label" for="newPass1">Contraseña</label>
                                        <input type="password" autocomplete="new-password" spellcheck="false" class="form-control" name="password" placeholder="" required>
                                    </div>
                                </div>
                                <div class="text-center">
                                @if (Auth::user()->role == 'Shopkeeper' && isset(Auth::user()->brand_id))
                                    <input style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" type="submit" class="btn btn-primary text-center" value="Enviar">
                                @else
                                    <input type="submit" class="btn btn-primary text-center" value="Enviar">
                                @endif
                                </div>
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
