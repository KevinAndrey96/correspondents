@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 ">Gestion de usuarios
                                @if ($role == 'Shopkeeper' || $role == 'allShopkeepers')
                                    (Tenderos)
                                @elseif ($role == 'Distributor')
                                    (Distribuidores)
                                @elseif ($role == 'Supplier')
                                    (Proveedores)
                                @elseif ($role == 'Administrator')
                                    (Administradores)
                                @endif
                                @if ($role != 'allShopkeepers')
                                    <a href="/user/create?role={{$role}}" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">group_add</i></a></h6>
                                @endif
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="tabla1" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bloq/Desbl</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                        @if ($role == 'allShopkeepers')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Distribuidor</th>
                                        @endif
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
                                        @if ($role == 'Distributor' || $role == 'Supplier' || $role == 'allShopkeepers')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ganancia</th>
                                        @endif
                                        @if ($role != 'Distributor' && $role != 'Administrator')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo</th>
                                        @endif
                                        @if ($role == 'Supplier')
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cola maxima</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prioridad</th>
                                        @endif
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            @if ($user->is_enabled == 1)
                                                <span class="badge badge-sm bg-gradient-success">En Línea</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Fuera de Línea</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm ps-0">
                                            <div class="form-check form-switch align-middle text-center">
                                                @if ($user->is_enabled == 1)
                                                    <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{$user->id}}" checked onchange="getStatus({{$user->id}})">
                                                    <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="togglestatus{{$user->id}}"></label>
                                                @else
                                                    <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{$user->id}}" onchange="getStatus({{$user->id}})">
                                                    <label class="form-check-label text-body ms-0 text-truncate w-0 mb-80" for="togglestatus{{$user->id}}"></label>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">{{$user->name}}</td>
                                        @if ($role == 'allShopkeepers')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{$user->distributor->name}}</th>
                                        @endif
                                        <!--<td class="align-middle text-center text-sm">{{$user->email}}</td>-->
                                        <td class="align-middle text-center text-sm">{{$user->phone}}</td>
                                        @if ($role == 'Distributor' || $role == 'Supplier' || $role == 'allShopkeepers')
                                            <td class="align-middle text-center text-sm">${{$user->profit}}</td>
                                        @endif
                                        @if ( $role == 'allShopkeepers' || ($role != 'Distributor' && $role != 'Administrator'))
                                            <td style="display: none;" class="">${{number_format($user->balance, 2, ',', '.')}}</td>
                                            <td class="align-middle text-center text-sm">${{number_format($user->balance, 2, ',', '.')}}</td>
                                        @endif
                                        @if ($role == 'Supplier')
                                            <td class="align-middle text-center text-sm">{{$user->max_queue}}</td>
                                            <td class="align-middle text-center text-sm">{{$user->priority}}</td>
                                        @endif
                                        <td>
                                            @if ($role != 'allShopkeepers' && $role != 'Administrator')
                                                <a style="color: dodgerblue;" href="/commissions/create/{{$user->id}}" title="Comisiones" class="btn btn-link px-1 mb-0"><i style="color: dodgerblue;" class="material-icons opacity-10">price_change</i></a>
                                            @endif
                                            <a style="color: darkgreen;" href="/user/edit/{{$user->id}}" title="Editar" class="btn btn-link px-1 mb-0"><i style="color: darkgreen;" class="material-icons opacity-10">edit</i></a>
                                            @if ($role == 'allShopkeepers' or $role == 'Supplier')
                                                <button style=" margin-top: 15px; " type="button" class="btn btn-white px-0" title="Gestionar saldo" data-bs-toggle="modal" data-bs-target="#SaldoModal"
                                                    data-id="{{$user->id}}"
                                                ><i class="material-icons opacity-10">monetization_on</i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <form id="form-status" name="form-status" method="POST" action="/changeStatusUser">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="status" id="status">
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

                                        if (toggle.checked === true) {
                                            status.value = 1;
                                        } else {
                                            status.value = 0;
                                        }
                                        user_id.value = id;
                                        form.submit();
                                    }
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
                                                            <input type="number" class="form-control" name="amount" value="" id="amount" step="1" min="0" placeholder="Monto">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="name" class="form-label"></label>
                                                        <input type="text" class="form-control" name="comment" id="comment" placeholder="Comentario">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="p-3">
                                                            <label for="image" > Recibo (Opcional) </label>
                                                            @if(isset($balance->boucher))
                                                            <img class="img-thumbnail img-fluid" src="{{ 'https://corresponsales.asparecargas.net/'.$balance->boucher }}" width="100" alt = "No carga">
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
                            <script>
                                $('#SaldoModal').on('show.bs.modal', function (event) {
                                    var button = $(event.relatedTarget)
                                    var uID = button.data('id')
                                    var modal = $(this)

                                    modal.find('.modal-body #userID').val(uID)
                                })
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
