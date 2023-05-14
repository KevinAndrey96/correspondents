@extends('layouts.dashboard')
@section('content')
    <div class="row mt-4">
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Publicidad<a href="{{route('publicity.create')}}" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">library_add</i></a></h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <div class="row">
                                @foreach($publicity as $value)
                                <div class="col-md-3 m-2 ms-auto me-auto d-flex w-20">
                                    <div class="card card-profile p-0 m-0">
                                        <div class="position-relative">
                                            <a class="image-link" href="{{getenv('URL_SERVER').$value->publicity_url}}">
                                                <img src="{{getenv('URL_SERVER').$value->publicity_url}}" alt="Image placeholder" class="card-img-top">
                                            </a>
                                        </div>
                                        <div class="card-body text-center border-0 p-0">
                                            <div class="d-flex justify-content-center">
                                                <div class="d-inline">
                                                    <a style="color: darkred;" href="{{route('publicity.delete', ['id' => $value->id])}}" title="Eliminar" class="btn btn-link px-1 mb-0" onclick="return confirm('¿Está seguro que quiere eliminar esta publicidad?');"><i style="color: darkred; font-size: 25px !important;" class="material-icons opacity-10">delete</i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
