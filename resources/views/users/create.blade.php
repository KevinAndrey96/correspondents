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
                        @if (isset(Auth::user()->brand_id))
                            <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            @else
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                    @endif
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
                                    @if ($role == 'Distributor')
                                    <div class="col-md-4">
                                        <div class="input-group input-group-static mb-4">
                                            <label  for="">Marca blanca</label>
                                            <select id="type" name="brand" class="form-control" aria-label="Default select example">
                                                <option class="text-center" value="" selected>Seleccionar</option>
                                                @foreach($brands as $brand)
                                                    <option class="text-center" value="{{$brand->id}}">{{$brand->domain}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($role == 'Supplier')
                                        <div class="col-md-4">
                                            <div class=" input-group input-group-outline my-3">
                                                <label for="priority" class="form-label">Prioridad</label>
                                                <input type="number" class="form-control" name="priority" min="1" value="" id="" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class=" input-group input-group-outline my-3">
                                                <label for="max_queue" class="form-label">Máxima cola de transacciones</label>
                                                <input type="number" class="form-control" name="max_queue" min="1" value="" id="" placeholder="" required>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($role == 'Supplier' )
                                        <div class="col-md-4">
                                            <div class=" input-group input-group-outline my-3">
                                                <label for="max_queue" class="form-label">Monto mínimo de solicitud de saldo</label>
                                                <input type="number" class="form-control" name="balanceMinAmount" min="1" step="0.01" value="" id="" placeholder="" required>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($role == 'Saldos')
                                        <div class="container mt-3 mb-3 border ">
                                            <p><strong>Seleccione Bancos:</strong></p>
                                            <div class="row">
                                                @foreach($cards as $card)
                                                    <div class="col-md-4 form-check mt-2 mb-2 justify-content-center">
                                                        <input style="" type="checkbox" class="form-check-input" name="card_ids[]"
                                                               value="{{$card->id}}">
                                                        <label>{{strtoupper($card->bank)}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    @if ($role == 'Shopkeeper')
                                        <div class="col-md-4">
                                            <label class="form-label">Seleccione un asesor:</label>
                                            <select class="form-select" name="adviserID" id="adviserID" required>
                                                <option value="none">Ninguno</option>
                                                @foreach ($advisers as $adviser)
                                                    <option value="{{$adviser->id}}">{{strtoupper($adviser->name)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @if ($role !== 'Advisers')
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="max_queue" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" name="password" value="" id="" placeholder="" required>
                                        </div>
                                    </div>
                                    @endif
                                    @if (Auth::user()->role == 'Administrator')
                                    <div class="col-md-4">
                                        <div class="input-group input-group-static mb-4">
                                            <select id="" name="roleID" class="form-control" aria-label="Default select example" required>
                                                <option class="text-center" value="" disabled selected>Tipo de usuario</option>
                                                <option class="text-center" value="">Sin tipo de usuario</option>
                                                @foreach ($roles as $item)
                                                    <option class="text-center" value="{{$item->id}}">
                                                        @if ($item->name == 'Administrator')
                                                            Administrador
                                                            @elseif ($item->name == 'Shopkeeper')
                                                                Tendero
                                                            @elseif ($item->name == 'Supplier')
                                                                Proveedor
                                                            @elseif ($item->name == 'Distributor')
                                                                Distribuidor
                                                            @elseif ($item->name == 'Saldos')
                                                                Saldos
                                                        @else
                                                            {{$item->name}}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    @if ((Auth::user()->role == 'Administrator' && $role == 'Distributor') || (Auth::user()->role == 'Distributor' && Auth::user()->developer_mode == true && $role == 'Shopkeeper'))
                                        <div class="col-md-4">
                                            <div class="input-group input-group-static mb-4">
                                                <select name="developerMode" id="developerMode" class="form-control" aria-label="Default select example" required>
                                                    <option class="text-center" value="" disabled selected>Modo desarrollador</option>
                                                    <option class="text-center" value="1">Si</option>
                                                    <option class="text-center" value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="text-center">
                                        <input type="hidden" value="{{$role}}" name="role">
                                        @if (isset(Auth::user()->brand_id))
                                            <input style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="btn btn-primary" type="submit" value="Guardar">
                                        @else
                                            <input class="btn btn-primary" type="submit" value="Guardar">
                                        @endif
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
