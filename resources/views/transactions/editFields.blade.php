@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href=""
                                                                                              class="btn btn-block"><i style="color: white; margin-top: 13px;"
                                                                                                                       class="material-icons opacity-10">keyboard_return</i></a>Editar campos de producto</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form action="{{route('transactions.fields-store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="document" class="form-label">Documento</label>
                                            <input type="text" class="form-control" name="document" value="{{$transactionFields->document}}" id="document" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="document_type" class="form-label">Tipo de documento</label>
                                            <input type="text" class="form-control" name="document_type" value="{{$transactionFields->document_type}}" id="phone" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-outline my-3">
                                            <label for="email" class="form-label">Correo</label>
                                            <input type="text" class="form-control" name="email" value="{{$transactionFields->email}}" id="document" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-outline my-3">
                                            <label for="first_code" class="form-label">Código</label>
                                            <input type="text" class="form-control" name="first_code" value="{{$transactionFields->first_code}}" id="code" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-outline my-3">
                                            <label for="second_code" class="form-label">Segundo código</label>
                                            <input type="text" class="form-control" name="second_code" value="{{$transactionFields->second_code}}" id="code" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-outline my-3">
                                            <label for="client_name " class="form-label">Nombre del cliente</label>
                                            <input type="text" class="form-control" name="client_name" value="{{$transactionFields->client_name}}" id="code" placeholder="" required>
                                        </div>
                                    </div>
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
