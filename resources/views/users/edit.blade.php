@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href="/home" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a> Editar Usuario</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="/user/update">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="name" class="form-label"></label>
                                            <input type="text" class="form-control" name="name" value="{{$user->name}}" id="" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="email" class="form-label"></label>
                                            <input type="email" class="form-control" name="email" value="{{$user->email}}" id="" placeholder="Correo electrónico">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="phone" class="form-label"></label>
                                            <input type="text" class="form-control" name="phone" value="{{$user->phone}}" id="" placeholder="Teléfono">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group input-group-static mb-4">
                                            <label  for="document_type">&nbsp&nbsp&nbsp&nbspTipo de documento {{$user->document_type}}</label>
                                            <select id="" name="document_type" class="form-control" aria-label="Default select example">
                                                @if ($user->document_type == 'CC')
                                                    <option class="text-center" value="CC" selected>C.C</option>
                                                    <option class="text-center" value="TI">T.I</option>
                                                    <option class="text-center" value="NIT">NIT</option>
                                                @elseif ($user->document_type == 'TI')
                                                    <option class="text-center" value="TI" selected>T.I</option>
                                                    <option class="text-center" value="CC">C.C</option>
                                                    <option class="text-center" value="NIT">NIT</option>
                                                @elseif ($user->document_type == 'NIT')
                                                    <option class="text-center" value="NIT" selected>NIT</option>
                                                    <option class="text-center" value="CC">C.C</option>
                                                    <option class="text-center" value="TI">T.I</option>
                                                @else
                                                    <option class="text-center" value="CC" selected>C.C</option>
                                                    <option class="text-center" value="TI">T.I</option>
                                                    <option class="text-center" value="NIT">NIT</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="document" class="form-label"></label>
                                            <input type="text" class="form-control" name="document" value="{{$user->document}}" id="" placeholder="N° documento">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="city" class="form-label"></label>
                                            <input type="text" class="form-control" name="city" value="{{$user->city}}" id="" placeholder="Ciudad">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="address" class="form-label"></label>
                                            <input type="text" class="form-control" name="address" value="{{$user->address}}" id="" placeholder="Dirección">
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="balance" class="form-label"></label>
                                            <input type="number" class="form-control" name="balance" min="1" value="{{$user->balance}}" id="" placeholder="Saldo">
                                        </div>
                                    </div>
                                    -->
                                    @if (isset($user->max_queue))
                                        <div class="col-md-4">
                                            <div class=" input-group input-group-outline my-3">
                                                <label for="max_queue" class="form-label"></label>
                                                <input type="number" class="form-control" name="max_queue" min="1" value="{{$user->max_queue}}" id="" placeholder="Maxima cola de transacciones">
                                            </div>
                                        </div>
                                    @endif
                                    @if (isset($user->priority))
                                        <div class="col-md-4">
                                            <div class=" input-group input-group-outline my-3">
                                                <label for="priority" class="form-label"></label>
                                                <input type="number" class="form-control" name="priority" min="1" value="{{$user->priority}}" id="" placeholder="Prioridad">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="max_queue" class="form-label"></label>
                                            <input type="password" class="form-control" name="password" value="" id="" placeholder="Contraseña">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <input type="hidden" value="{{$user->id}}" name="user_id">
                                        <input class="btn btn-primary" type="submit" value="Guardar Cambios">
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
