@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href="{{route('brands.index')}}"
                                                                                              class="btn btn-block"><i style="color: white; margin-top: 13px;"
                                                                                                                       class="material-icons opacity-10">keyboard_return</i></a>Crear marca blanca</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form action="{{route('brands.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="domain" class="form-label">Dominio</label>
                                            <input type="text" class="form-control" name="domain" id="domain" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="square_logo" class="form-label">Logo cuadrado:</label>
                                        <input class="form-control form-control-sm" type="file" name="square_logo" id="formFile" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="rectangular_logo" class="form-label">Logo rectangular:</label>
                                        <input class="form-control form-control-sm" type="file" name="rectangular_logo" id="formFile" required>
                                    </div>
                                    <!--
                                    <div class="col-md-3 mb-3">
                                        <label for="banner" class="form-label">Banner:</label>
                                        <input class="form-control form-control-sm" type="file" name="banner" id="formFile" required>
                                    </div>
                                    -->
                                    <div class="col-md-3 mb-3">
                                        <label for="primary_color" class="form-label">Color principal</label>
                                        <div class="d-flex justify-content-center">
                                            <input type="color" class="form-control form-control-color" name="primary_color" value="#3355FF" title="Elige un color">
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-md-3 mb-3">
                                        <label for="secondary_color" class="form-label">Color secundario</label>
                                        <div class="d-flex justify-content-center">
                                            <input type="color" class="form-control form-control-color" name="secondary_color" value="#33FF5E" title="Elige un color">
                                        </div>
                                    </div>
                                    -->
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <input type="submit" class="btn btn-success bg-gradient" value="Guardar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
