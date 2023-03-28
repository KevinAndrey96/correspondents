@extends('layouts.dashboard')
@section('content')
    @if(Session::has('unfulfilledRequirements'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('unfulfilledRequirements') }}
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href="/users?role={{$role}}" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a> Crear Usuario
                                @if ($role == 'Shopkeeper')
                                    (Tenderos)
                                @elseif ($role == 'Distributor')
                                    (Distribuidores)
                                @elseif ($role == 'Supplier')
                                    (Proveedores)
                                @elseif ($role == 'Administrator')
                                    (Administradores)
                                @elseif ($role == 'Saldos')
                                    (S & G)
                                @endif
                            </h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="/user/store">
                                <div class="row">
                                    @csrf
                                    @if(count($errors)>0)
                                        <div class="alert alert-danger" role="alert">
                                            <ul>
                                            @foreach( $errors->all() as $error )
                                                    <li><p class="text-center text-sm text-white"> {{ $error }}</p> </li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="name" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" name="name" value="" id="" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group input-group-static mb-4">
                                            <label  for="document_type">Tipo de documento</label>
                                            <select id="" name="document_type" class="form-control" aria-label="Default select example" required>
                                                <option class="text-center" value="CC">C.C</option>
                                                <option class="text-center" value="TI">T.I</option>
                                                <option class="text-center" value="NIT">NIT</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="document" class="form-label">N° documento</label>
                                            <input type="text" class="form-control" name="document" value="" id="" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="phone" class="form-label">Teléfono</label>
                                            <input type="text" class="form-control" name="phone" value="" id="" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="city" class="form-label">Ciudad</label>
                                            <input type="text" class="form-control" name="city" value="" id="" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="email" class="form-label">Correo electrónico</label>
                                            <input type="email" class="form-control" name="email" value="" id="" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="address" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" name="address" value="" id="" placeholder="" required>
                                        </div>
                                    </div>
                                    @if ($role == 'Supplier')
                                        <div class="col-md-4">
                                            <div class=" input-group input-group-outline my-3">
                                                <label for="priority" class="form-label">Prioridad</label>
                                                <input type="number" class="form-control" name="priority" min="1" value="" id="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class=" input-group input-group-outline my-3">
                                                <label for="max_queue" class="form-label">Maxima cola de transacciones</label>
                                                <input type="number" class="form-control" name="max_queue" min="1" value="" id="" placeholder="" required>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($role == 'Saldos')
                                    <div class="col-md-4">
                                        <select class="form-select form-select-lg mb-3" name="product_id" aria-label=".form-select-lg example" required>
                                            <option selected disabled><p style="font-weight:bold">Seleccione un banco</p></option>
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}">{{strtoupper($product->product_name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="max_queue" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" name="password" value="" id="" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <input type="hidden" value="{{$role}}" name="role">
                                        <input class="btn btn-primary" type="submit" value="Guardar">
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
