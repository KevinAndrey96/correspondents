@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 ">Gestion de usuarios <a href="/user/create?role={{$role}}" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">group_add</i></a></h6>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bloq/Desbl</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">T. Documento</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° Documento</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ciudad</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dirección</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comisión</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo</th>
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
                                                <span class="badge badge-sm bg-gradient-success">OnLine</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">OffLine</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm ps-0">
                                            <div class="form-check form-switch ">
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
                                        <td class="align-middle text-center text-sm">{{$user->email}}</td>
                                        <td class="align-middle text-center text-sm">{{$user->phone}}</td>
                                        <td class="align-middle text-center text-sm">{{$user->document_type}}</td>
                                        <td class="align-middle text-center text-sm">{{$user->document}}</td>
                                        <td class="align-middle text-center text-sm">{{$user->city}}</td>
                                        <td class="align-middle text-center text-sm">{{$user->address}}</td>
                                        <td class="align-middle text-center text-sm">{{$user->commission}}</td>
                                        <td class="align-middle text-center text-sm">{{$user->balance}}</td>
                                        @if ($role == 'Supplier')
                                            <td class="align-middle text-center text-sm">{{$user->max_queue}}</td>
                                            <td class="align-middle text-center text-sm">{{$user->priority}}</td>
                                        @endif
                                        <td class="align-middle text-center text-sm">
                                                <a style="color: darkgreen;" href="/user/edit/{{$user->id}}" class="btn btn-link px-3 mb-0"><i style="color: darkgreen;" class="material-icons opacity-10">edit</i> Editar</a>
                                                <a style="color: red;" class="btn btn-link px-3 mb-0" href="/user/delete/{{$user->id}}" onclick="return confirm('¿Está seguro que quiere eliminar el usuario?');"><i style="color: red;" class="material-icons opacity-10">delete</i>Borrar</a>
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
                                    var toggle = document.getElementById("togglestatus"+id);
                                    var status = document.getElementById("status");
                                    var form = document.getElementById("form-status");
                                    var user_id = document.getElementById("id");

                                    if (toggle.checked == true) {
                                        status.value = 1;
                                    } else {
                                        status.value = 0;
                                    }
                                    user_id.value = id;
                                    form.submit();
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
