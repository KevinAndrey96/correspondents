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
                        @if (Auth::user()->role == 'Distributor' && isset(Auth::user()->brand_id))
                            <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href="/home" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a> Editar Usuario</h6>
                            </div>
                        @else
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href="/home" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a> Editar Usuario</h6>
                            </div>
                        @endif

                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="/user/update" enctype="multipart/form-data">
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
                                                    <option class="text-center" value="CC" selected>p</option>
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
                                    @if ($user->role == 'Shopkeeper')
                                        <div class="col-md-4">
                                            <label class="form-label">Seleccione un asesor:</label>
                                            <select class="form-select" name="adviserID" id="adviserID" required>
                                                @if (isset($shopkeeperAdviser))
                                                    <option value="none">Ninguno</option>
                                                @else
                                                    <option value="none" selected>Ninguno</option>
                                                @endif

                                                @foreach ($advisers as $adviser)
                                                    @if (isset($shopkeeperAdviser))
                                                        @if ($shopkeeperAdviser->adviser_id == $adviser->id)
                                                            <option value="{{$adviser->id}}" selected>{{strtoupper($adviser->name)}}</option>
                                                        @else
                                                            <option value="{{$adviser->id}}">{{strtoupper($adviser->name)}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$adviser->id}}">{{strtoupper($adviser->name)}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label"></label>
                                                <input type="text" class="form-control" name="multiproductosID"
                                                       @if (! is_null($user->multiproductosID))
                                                            value="{{$user->multiproductosID}}"
                                                       @endif
                                                       id="multiproductosID"
                                                       placeholder="ID Multiproductos">
                                            </div>
                                        </div>
                                            <div class="col-md-4">
                                                <div class="input-group input-group-outline my-3">
                                                    <label for="address" class="form-label"></label>
                                                    <input type="text" class="form-control" name="platform_mul"
                                                           @if (! is_null($user->platform_mul))
                                                           value="{{$user->platform_mul}}"
                                                           @endif
                                                           id="platform_mul"
                                                           placeholder="Plataforma Multiproductos">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="cedulaPDF" class="">PDF o Imagen de Cedula:</label>
                                                    <input id="cedulaPDF" type="file" class="form-control-file" name="cedulaPDF">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="cedulaPDF" class="">PDF o Imagen de RUT:</label>
                                                    <input id="rutPDF" type="file" class="form-control-file" name="rutPDF">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="camara_comercio" class="">Cámara y comercio (opcional):</label>
                                                    <input id="camara_comercio" type="file" class="form-control-file" name="camara_comercio">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="local_photo" class="">Foto local:</label>
                                                    <input id="local_photo" type="file" class="form-control-file" name="local_photo">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label for="public_receipt" class="">Foto de recibo público:</label>
                                                    <input id="public_receipt" type="file" class="form-control-file" name="public_receipt">
                                                </div>
                                            </div>
                                    @endif

                                    @if ($user->role == 'Distributor')
                                        <div class="col-md-4">
                                            <div class="input-group input-group-static mb-4">
                                                <label  for="">Marca blanca</label>
                                                <select id="type" name="brand" class="form-control" aria-label="Default select example">
                                                    <option class="text-center" value="">Seleccionar</option>
                                                    @foreach($brands as $brand)
                                                        @if ($brand->id == $user->brand_id)
                                                            <option class="text-center" value="{{$brand->id}}" selected>{{$brand->domain}}</option>
                                                        @else
                                                            <option class="text-center" value="{{$brand->id}}">{{$brand->domain}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($user->role == 'Saldos')
                                        <div class="container mt-3 mb-3 border">
                                            <p><strong>Seleccione Bancos:</strong></p>
                                            <div class="row">
                                                @foreach ($cards as $card)
                                                    <div class="col-md-4 form-check mt-2 mb-2 justify-content-center">
                                                        <input style="" type="checkbox" class="form-check-input" name="card_ids[]"
                                                               value="{{$card->id}}"
                                                                    @foreach ($userBanks as $uBank)
                                                                        @if ($uBank->card_id == $card->id)
                                                                            checked
                                                                            @break
                                                                            @endif
                                                                    @endforeach>
                                                        <label>{{strtoupper($card->bank)}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if (isset($user->max_queue))
                                        <div class="col-md-4">
                                            <div class=" input-group input-group-outline my-3">
                                                <label for="max_queue" class="form-label"></label>
                                                <input type="number" class="form-control" name="max_queue" min="1" value="{{$user->max_queue}}" id="" placeholder="Máxima cola de transacciones">
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

                                    @if (($user->role == 'Shopkeeper' || $user->role == 'Supplier') &&
                                        Auth::user()->role == 'Administrator')
                                        <div class="col-md-4">
                                            <div class=" input-group input-group-outline my-3">
                                                <label for="balanceMinAmount" class="form-label"></label>
                                                <input type="number" class="form-control" name="balanceMinAmount" min="1"
                                                       @if (isset($user->balance_min_amount))
                                                           value="{{$user->balance_min_amount}}"
                                                       @endif
                                                       id="" placeholder="Monto mínimo de solicitud de saldo">
                                            </div>
                                        </div>
                                    @endif

                                    @if ($user->role !== 'Advisers')
                                    <div class="col-md-4">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="max_queue" class="form-label"></label>
                                            <input type="password" class="form-control" name="password" value="" id="" placeholder="Contraseña">
                                        </div>
                                    </div>
                                    @endif
                                    @if (Auth::user()->role == 'Administrator')
                                        <div class="col-md-4">
                                            <div class="input-group input-group-static mb-4">
                                                <label  for="userType">Tipo de usuario</label>
                                                <select id="" name="roleID" class="form-control" aria-label="Default select example" required>
                                                    <option class="text-center" value="" disabled>Tipo de usuario</option>
                                                    <option class="text-center" value="" selected>Sin tipo de usuario</option>
                                                    @foreach ($roles as $item)
                                                        @if ($item->id == $roleID)
                                                            <option class="text-center" value="{{$item->id}}" selected>
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
                                                        @else
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
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif

                                    @if ((Auth::user()->role == 'Administrator' && $user->role == 'Distributor') ||
                                        (Auth::user()->role == 'Administrator' && $user->role == 'Shopkeeper') ||
                                        (Auth::user()->role == 'Distributor' && Auth::user()->developer_mode && $user->role == 'Shopkeeper'))
                                        <div class="col-md-4">
                                            <div class="input-group input-group-static mb-4">
                                                <label for="developerMode">Modo desarrollador</label>
                                                <select name="developerMode" id="developerMode" class="form-control" aria-label="Default select example" onchange="showDeveloperModeInputs(this.id)" required>
                                                    <option class="text-center" value="" disabled>Modo desarrollador</option>
                                                    <option class="text-center" value="0"
                                                        {{(! $user->developer_mode) ? 'selected' : ''}}>No</option>
                                                    <option class="text-center" value="1"
                                                        {{($user->developer_mode) ? 'selected' : ''}}>Si</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="{{($user->developer_mode) ? 'display:block;' : 'display:none;'}};" id="webhookURLDiv">
                                            <div class="input-group input-group-static mb-4">
                                                <label for="webhookURL"></label>
                                                <input type="text" class="form-control" name="webhookURL"
                                                       @if (! is_null($user->webhook_url))
                                                           value="{{$user->webhook_url}}"
                                                       @endif
                                                       id="webhookURL"
                                                       placeholder="Webhook URL"
                                                    {{(!$user->developer_mode) ? 'disabled' : ''}}
                                                >
                                            </div>
                                        </div>
                                    @endif

                                    <div class="text-center mt-4">
                                        <input type="hidden" value="{{$user->id}}" name="user_id">
                                        <input type="hidden" value="{{$roleID}}" name="oldRoleID">
                                        @if (Auth::user()->role == 'Distributor' && isset(Auth::user()->brand_id))
                                            <input style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="btn btn-primary" type="submit" value="Guardar Cambios">
                                        @else
                                            <input class="btn btn-primary" type="submit" value="Guardar Cambios">
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

    <script type="text/javascript">

        function showDeveloperModeInputs(id)
        {
            let developerModeSelect = document.getElementById(id);
            let webhookURLDiv = document.getElementById('webhookURLDiv');
            let webhookURLInput = document.getElementById('webhookURL');

            console.log(webhookURLInput);
            webhookURLDiv.style.display = 'none';
            webhookURLInput.disabled = true;

            if (developerModeSelect.value == "1") {
                webhookURLDiv.style.display = 'block';
                webhookURLInput.disabled = false;
            }
        }

    </script>

@endsection
