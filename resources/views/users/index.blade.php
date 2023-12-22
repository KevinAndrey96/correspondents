@extends('layouts.dashboard')
@section('content')
    @if(Session::has('successfulAssignment'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successfulAssignment') }}
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        @if (Auth::user()->role == 'Distributor' && isset(Auth::user()->brand_id))
                            <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            @else
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                @endif
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 ">Gestión de usuarios
                                @if ($role == 'Shopkeeper' || $role == 'allShopkeepers')
                                    (Tenderos)<a class="btn btn-block btn-Secondary ps-0 p-4"></a>
                                @elseif ($role == 'Distributor')
                                    (Distribuidores)
                                @elseif ($role == 'Supplier')
                                    (Proveedores)
                                @elseif ($role == 'Administrator')
                                    (Administradores)
                                @elseif ($role == 'Saldos')
                                    (S & G)
                                @elseif ($role == 'Advisers')
                                    (Asesores)
                                @endif

                                @if ($role != 'allShopkeepers')
                                    <a href="/user/create?role={{$role}}" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">group_add</i></a></h6>
                                @endif
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="tabla1" class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        @if ($role !== 'Administrator' && $role !== 'Advisers')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Estado</th>
                                        @endif
                                        @if ($role == 'Supplier')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Conexión</th>
                                        @endif
                                        @if($role !== 'Administrator' && $role !== 'Advisers')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Habilitar</th>
                                            @endif
                                            @if(Auth::user()->role == 'Administrator')
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">QR</th>
                                            @endif
                                            @if ($role == 'allShopkeepers')
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 pl-auto pr-auto">Contraseña diaria</th>
                                            @endif
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                        @if ($role == 'allShopkeepers')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Distribuidor</th>
                                        @endif
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
                                        @if ($role == 'Distributor' || $role == 'Supplier' || $role == 'allShopkeepers')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ganancia</th>
                                        @endif
                                        @if ($role != 'Distributor' && $role != 'Administrator' && $role !== 'Advisers')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo</th>
                                        @endif
                                        @if ($role == 'Supplier')
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cola maxima</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prioridad</th>
                                        @endif
                                            @if ($role == 'Shopkeeper' || $role == 'allShopkeepers')
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Asesor</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Multiproductos</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plataforma Multiproductos</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-6">Documentos</th>
                                            @endif
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        @if ($role !== 'Administrator' && $role !== 'Advisers')
                                            <td class="align-middle text-center text-sm">
                                                @if ($user->is_authorized == 1)
                                                    <span class="badge badge-sm bg-gradient-success">Habilitado</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">Deshabilitado</span>
                                                @endif
                                            </td>
                                        @endif
                                            @if ($role == 'Supplier')
                                                <td class="align-middle text-center text-sm">
                                                    @if ($user->is_online == 1)
                                                        <span class="badge badge-sm bg-gradient-success">En Línea</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-secondary">Fuera de Línea</span>
                                                    @endif
                                                </td>
                                            @endif

                                        @if ($role !== 'Administrator' &&  $role !== 'Advisers')
                                        <td class="align-middle text-center text-sm">
                                            <div class="form-check form-switch align-middle text-center d-flex justify-content-center">
                                                @if ($user->is_authorized == 1)
                                                    <input class="form-check-input ml-auto mr-auto" type="checkbox" id="toggleauthorized{{$user->id}}" checked onchange="getAuthorized({{$user->id}})">
                                                @else
                                                    <input class="form-check-input ml-auto mr-auto" type="checkbox" id="toggleauthorized{{$user->id}}" onchange="getAuthorized({{$user->id}})">
                                                @endif
                                            </div>
                                        </td>
                                        @endif
                                            @if(Auth::user()->role == 'Administrator')
                                                <td class="align-middle text-center text-sm">
                                                    <div class="form-check form-switch align-middle text-center d-flex justify-content-center">
                                                    @if ($user->enabled_daily == 1)
                                                            <input class="form-check-input ml-auto mr-auto" type="checkbox" id="toggleEnabledDaily{{$user->id}}" checked onchange="getEnabledDaily({{$user->id}})">
                                                        @else
                                                            <input class="form-check-input ml-auto mr-auto" type="checkbox" id="toggleEnabledDaily{{$user->id}}" onchange="getEnabledDaily({{$user->id}})">
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                            @if ($role == 'allShopkeepers')
                                                <td class="align-middle text-center text-sm">
                                                    <div class="form-check form-switch align-middle text-center d-flex justify-content-center">
                                                        @if ($user->enabled_daily == 1)
                                                            <input class="form-check-input ml-auto mr-auto" type="checkbox" id="toggleEnabledDaily{{$user->id}}" checked onchange="getEnabledDaily({{$user->id}})">
                                                        @else
                                                            <input class="form-check-input ml-auto mr-auto" type="checkbox" id="toggleEnabledDaily{{$user->id}}" onchange="getEnabledDaily({{$user->id}})">
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                        <td class="align-middle text-center text-sm">{{$user->name}}</td>
                                        @if ($role == 'allShopkeepers')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{$user->distributor->name}}</th>
                                        @endif
                                        <td class="align-middle text-center text-sm">{{$user->phone}}</td>
                                        @if ($role == 'Distributor' || $role == 'Supplier' || $role == 'allShopkeepers')
                                            <td class="align-middle text-center text-sm">${{$user->profit}}</td>
                                        @endif
                                        @if ( $role == 'allShopkeepers' || ($role != 'Distributor' && $role != 'Administrator' && $role != 'Advisers'))
                                            <td class="align-middle text-center text-sm">${{number_format($user->balance, 2, ',', '.')}}</td>
                                        @endif
                                        @if ($role == 'Supplier')
                                            <td class="align-middle text-center text-sm">{{$user->max_queue}}</td>
                                            <td class="align-middle text-center text-sm">{{$user->priority}}</td>
                                        @endif
                                            @if ($role == 'Shopkeeper' || $role == 'allShopkeepers')
                                                <td class="align-middle text-center text-sm">
                                                    @foreach ($shopkeeperAdvisers as $shopkeeperAdviser)
                                                        @if ($shopkeeperAdviser->shopkeeper_id == $user->id)
                                                            {{$shopkeeperAdviser->adviser->name}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if (isset($user->multiproductosID))
                                                        {{$user->multiproductosID}}
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if (isset($user->platform_mul))
                                                        {{$user->platform_mul}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($user->cedulaPDF))
                                                        <a target="_blank" href="{{$urlServer.$user->cedulaPDF}}">
                                                            <img width="15%" title="Documento cedula" src="{{$urlServer}}/assets/img/documento-icono.png">
                                                        </a>
                                                    @endif
                                                    @if (isset($user->rutPDF))
                                                            <a target="_blank" href="{{$urlServer.$user->rutPDF}}">
                                                                <img width="15%" title="Documento RUT" src="{{$urlServer}}/assets/img/documento-icono.png">
                                                            </a>
                                                    @endif
                                                    @if (isset($user->camara_comercio))
                                                            <a target="_blank" href="{{$urlServer.$user->camara_comercio}}">
                                                                <img width="15%" title="Cámara y comercio" src="{{$urlServer}}/assets/img/documento-icono.png">
                                                            </a>
                                                    @endif
                                                    @if (isset($user->local_photo))
                                                            <a target="_blank" href="{{$urlServer.$user->local_photo}}">
                                                                <img width="15%" title="Foto local" src="{{$urlServer}}/assets/img/documento-icono.png">
                                                            </a>
                                                    @endif
                                                    @if (isset($user->public_receipt))
                                                            <a target="_blank" href="{{$urlServer.$user->public_receipt}}">
                                                                <img width="15%" title="Foto de recibo público" src="{{$urlServer}}/assets/img/documento-icono.png">
                                                            </a>
                                                    @endif
                                                </td>
                                            @endif
                                        <td>
                                            <div class="d-flex justify-content-center">
                                            @if ($role != 'allShopkeepers' && $role != 'Administrator' && $role != 'Saldos' && $role != 'Advisers')
                                                <a style="color: dodgerblue;" href="/commissions/create/{{$user->id}}" title="Comisiones" class="btn btn-link px-1 mb-0"><i style="color: dodgerblue; font-size: 25px !important;" class="material-icons opacity-15">price_change</i></a>
                                            @endif
                                            <a style="color: darkgreen;" href="/user/edit/{{$user->id}}" title="Editar" class="btn btn-link px-1 mb-0"><i style="color: darkgreen; font-size: 25px !important;" class="material-icons opacity-10">edit</i></a>
                                            @if ($role == 'allShopkeepers' or $role == 'Supplier')
                                                <button type="button" class="btn btn-white px-1 mb-0" title="Gestionar saldo" data-bs-toggle="modal" data-bs-target="#SaldoModal"
                                                    data-id="{{$user->id}}"><i style="font-size: 25px !important;" class="material-icons opacity-10">monetization_on</i></button>
                                            @endif
                                                <a style="color:#505050 ;" href="{{route('product.assign', ['id' => $user->id])}}" title="Asignar productos" class="btn btn-link px-1 mb-0"><i style="color: #505050; font-size: 25px !important;" class="material-icons opacity-10">assignment_turned_in</i></a>
                                                @if ($role == 'allShopkeepers' || $role == 'Distributor' || $role == 'Supplier')
                                                    <a style="color:#505050 ;" href="{{route('mode.spectator', ['id' => $user->id, 'isInspector' => 1])}}" title="Modo fantasma" class="btn btn-link px-1 mb-0" onclick="confirm('¿Está seguro que desea entrar en modo fantasma e iniciar sesión con este usuario?')"><i style="color: #505050; font-size: 25px !important;" class="material-icons opacity-10 text-primary">visibility</i></a>
                                                <!--
                                                    <button type="button" class="btn btn-white px-1 mb-0" title="Ver información del tendero"  data-bs-toggle="modal" data-bs-target="#ShopkeeperInfoModal"
                                                            data-id="{{$user->id}}"><i style="font-size: 25px !important;" class="material-icons opacity-10 text-primary" data-userID={{$user->id}}>visibility</i></button>
                                                            -->
                                                @endif
                                                <a style="color: darkred;" href="#" title="Eliminar" class="btn btn-link px-1 mb-0"><i style="color: darkred; font-size: 25px !important;" class="material-icons opacity-10" onclick="getStatus({{$user->id}})">delete</i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <style>
                                .form-control {
                                    background-color: #f2f2f2 !important ;
                                }
                            </style>
                            <script>
                                $(document).ready( function () {
                                    $('#tabla1').DataTable({
                                        "language": {
                                            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                                            "paginate": {
                                                "first": "Primero",
                                                "last": "Último",
                                                "next": "=>",
                                                "previous": "<="
                                            }
                                        },
                                        responsive: true,
                                        "pageLength": 15
                                    });
                                } );
                            </script>
                            <form id="form-status" name="form-status" method="POST" action="/changeStatusUser">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="status" id="status">
                            </form>
                            <form id="form-authorized" name="form-authorized" method="POST" action="{{route('users.shopkeeper.authorized')}}">
                                @csrf
                                <input type="hidden" name="id" id="user_id">
                                <input type="hidden" name="authorized" id="authorized">
                            </form>
                            <form id="form-enabled-daily" name="form-enabled-daily" method="POST" action="{{route('users.shopkeeper.enabled.daily')}}">
                                @csrf
                                <input type="hidden" name="id" id="shopkeeper_id">
                                <input type="hidden" name="enabled_daily" id="enabled_daily">
                            </form>
                            <script>
                                function getStatus(id)
                                {
                                    let text = "¿Está seguro que desea continuar con esta acción?";
                                    if (confirm(text) === true) {
                                        let toggle = document.getElementById("togglestatus" + id);
                                        let status = document.getElementById("status");
                                        let form = document.getElementById("form-status");
                                        let user_id = document.getElementById("id");
                                        status.value = 0;
                                        user_id.value = id;
                                        form.submit();
                                    }
                                }

                                function getAuthorized(id) {
                                        let toggle = document.getElementById("toggleauthorized" + id);
                                        let status = document.getElementById("authorized");
                                        let form = document.getElementById("form-authorized");
                                        let user_id = document.getElementById("user_id");

                                        if (toggle.checked === true) {
                                            status.value = 1;
                                        } else {
                                            status.value = 0;
                                        }
                                        user_id.value = id;
                                        form.submit();
                                }

                                function getEnabledDaily(id)
                                {
                                    let toggle = document.getElementById("toggleEnabledDaily" + id);
                                    let status = document.getElementById("enabled_daily");
                                    let form = document.getElementById("form-enabled-daily");
                                    let user_id = document.getElementById("shopkeeper_id");

                                    if (toggle.checked === true) {
                                        status.value = 1;
                                    } else {
                                        status.value = 0;
                                    }
                                    user_id.value = id;
                                    form.submit();
                                }
                            </script>
                            <!-- Modal-->
                            <div class="modal fade" id="SaldoModal" tabindex="-1" role="dialog" aria-labelledby="SaldoModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">Modificar saldo</h6>
                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/balance') }}" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    @csrf
                                                    @if(count($errors)>0)
                                                        <div class="alert alert-danger" role="alert">
                                                            <ul>
                                                                @foreach( $errors->all() as $error )
                                                                    <li> {{ $error }} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <div class="input-group input-group-outline my-3">
                                                        <input type="hidden" class="form-control" name="userID" value="" id="userID" readonly="readonly">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-static mb-4">
                                                            <label class="" for="">Tipo de transacción</label>
                                                            <select id="type" name="type" class="form-control" aria-label="Default select example">
                                                                <option class="text-center" value="Deposit">Depósito</option>
                                                                <option class="text-center" value="Withdrawal">Retiro</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-outline my-3">
                                                            <label for="amount"></label>
                                                            @if (getenv('COUNTRY_NAME') == 'ECUADOR')
                                                                <input type="number" class="form-control" name="amount" value="" id="amount" step="any" min="0" placeholder="Monto" max="10000">
                                                            @else
                                                                <input type="number" class="form-control" name="amount" value="" id="amount" step="any" min="0" placeholder="Monto">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="name" class="form-label"></label>
                                                        <input type="text" class="form-control" name="comment" id="comment" placeholder="Comentario">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="p-3">
                                                            <label for="image" > Recibo (Opcional) </label>
                                                            @if(isset($balance->boucher))
                                                            <img class="img-thumbnail img-fluid" src="{{ $urlServer.'/'.$balance->boucher }}" width="100" alt = "No carga">
                                                            @endif
                                                            <input style="border: gray 0.5px solid; border-radius: 20px" type="file" class="form-control form-control-sm" name="image" value="" id="image">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <input class="btn btn-success" type="submit" value="Gestionar saldo" onclick="return confirm('¿Está seguro de realizar la transacción?')">
                                                        @if($role == 'allShopkeepers')
                                                        <a class="btn btn-primary" href="{{ url('users?role=allShopkeepers') }}"> Regresar</a>
                                                        @elseif($role == 'Supplier')
                                                        <a class="btn btn-primary" href="{{ url('users?role=Supplier') }}"> Regresar</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end Modal-->
                            <!-- Modal-->
                            <div class="modal fade" id="ShopkeeperInfoModal" tabindex="-1" role="dialog" aria-labelledby="SaldoModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">Información tendero</h6>
                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <li class="list-group-item text-center"><a id="transactionLink" href="">Transacciones</a></li>
                                                <li class="list-group-item text-center"><a id="commissionLink" href="">Comisiones</a></li>
                                                <li class="list-group-item text-center"><a id="balanceLink" href="">Saldos</a></li>
                                                <li class="list-group-item text-center"><a id="profitLink" href="">Historial de retiro de ganancias</a></li>
                                                <li class="list-group-item text-center">
                                                    <div class="row">
                                                        <form id="form-excel" method="POST" action="/balanceSummary/excel">
                                                            @csrf
                                                            <input type="hidden" name="shopkeeper_id" id="usershop_id">
                                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                                <div class="input-group date mb-4">
                                                                    <label>Desde: </label>
                                                                    <input type="date" class="form-control ms-2" id="dateFrom" name="dateFrom" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                                <div class="input-group date mb-4">
                                                                    <label>Hasta: </label>
                                                                    <input type="date" class="form-control ms-2" id="dateTo" name="dateTo" required>
                                                                </div>
                                                            </div>
                                                            <input type="submit" class="btn btn-success" value="Descargar extracto">
                                                        </form>
                                                        <!--<a href="" onclick="summaryExtract()">Descargar extracto de saldos</a>-->
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end Modal-->
                            <script>
                                $('#SaldoModal').on('show.bs.modal', function (event) {
                                    var button = $(event.relatedTarget)
                                    var uID = button.data('id')
                                    var modal = $(this)

                                    modal.find('.modal-body #userID').val(uID)
                                })
                                $('#ShopkeeperInfoModal').on('show.bs.modal', function (event) {
                                    var button = $(event.relatedTarget)
                                    var uID = button.data('id')
                                    var modal = $(this)
                                    modal.find('.modal-body #transactionLink').attr('href', '/transactions?shopkeeper_id=' + uID);
                                    modal.find('.modal-body #commissionLink').attr('href', '/commissions?shopkeeper_id=' + uID);
                                    modal.find('.modal-body #balanceLink').attr('href', '/balance?shopkeeper_id=' + uID);
                                    modal.find('.modal-body #profitLink').attr('href', '/profit?shopkeeper_id=' + uID);
                                    modal.find('.modal-body #profitLink').attr('href', '/profit?shopkeeper_id=' + uID);
                                    modal.find('.modal-body #usershop_id').val(uID);
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
