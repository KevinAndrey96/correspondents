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
                                <a href="/user/create?role={{$role}}" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">group_add</i></a></h6>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bloq/Desbl</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
                                        <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">T. Documento</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° Documento</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ciudad</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dirección</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comisión</th>-->
                                        @if ($role != 'Distributor' and $role != 'Administrator')
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
                                                <span class="badge badge-sm bg-gradient-success">OnLine</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">OffLine</span>
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
                                        <!--<td class="align-middle text-center text-sm">{{$user->email}}</td>-->
                                        <td class="align-middle text-center text-sm">{{$user->phone}}</td>
                                    <!-- <td class="align-middle text-center text-sm">{{$user->document_type}}</td>
                                        <td class="align-middle text-center text-sm">{{$user->document}}</td>
                                        <td class="align-middle text-center text-sm">{{$user->city}}</td>
                                        <td class="align-middle text-center text-sm">{{$user->address}}</td>-->
                                        <!--<td class="align-middle text-center text-sm">{{$user->commission}}</td>-->
                                        @if ($role != 'Distributor' and $role != 'Administrator')
                                        <td class="align-middle text-center text-sm">{{$user->balance}}</td>
                                        @endif
                                        @if ($role == 'Supplier')
                                            <td class="align-middle text-center text-sm">{{$user->max_queue}}</td>
                                            <td class="align-middle text-center text-sm">{{$user->priority}}</td>
                                        @endif
                                        <td class="align-middle text-center text-sm">
                                            <button style="padding: 6px; font-size: 9px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalMessage"
                                                    data-whatever="{{$user->name}}"
                                                    data-doc="{{$user->document_type}}"
                                                    data-email="{{$user->email}}"
                                                    data-numberdoc="{{$user->document}}"
                                                    data-city="{{$user->city}}"
                                                    data-address="{{$user->address}}"
                                            >Detalles</button>
                                                <a style="color: darkgreen;" href="/user/edit/{{$user->id}}" class="btn btn-link px-3 mb-0"><i style="color: darkgreen;" class="material-icons opacity-10">edit</i> Editar</a>
                                                <a style="color: red;" class="btn btn-link px-3 mb-0" href="/user/delete/{{$user->id}}" onclick="return confirm('¿Está seguro que quiere eliminar el usuario?');"><i style="color: red;" class="material-icons opacity-10">delete</i></a>
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
                            <!-- modal -->
                            <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">Detalles</h6>
                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="row pb-2">
                                                    <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                        <div class="card">
                                                            <div class="card-header p-0 ">
                                                                <div class="icon icon-x icon-shape bg-gradient-dark shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                    <i class="material-icons opacity-10">article</i>
                                                                </div>
                                                                <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                    <label for="recipient-doc" id="doc" class="col-form-label text-xs"></label>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer p-1"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                        <div class="card">
                                                            <div class="card-header p-0 ">
                                                                <div class="icon icon-x icon-shape bg-gradient-primary shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                    <i class="material-icons opacity-10">assignment_ind</i>
                                                                </div>
                                                                <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                    <label for="recipient-number-doc" id="numberdoc" class="col-form-label text-xs"></label>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer p-1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pb-2">
                                                    <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                        <div class="card">
                                                            <div class="card-header p-0 ">
                                                                <div class="icon icon-x icon-shape bg-gradient-dark shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                    <i class="material-icons opacity-10">location_city</i>
                                                                </div>
                                                                <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                    <label for="recipient-city" id="city" class="col-form-label text-xs"></label>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer p-1"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                        <div class="card">
                                                            <div class="card-header p-0 ">
                                                                <div class="icon icon-x icon-shape bg-gradient-primary shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                    <i class="material-icons opacity-10">pin</i>
                                                                </div>
                                                                <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                    <label for="recipient-address" id="address" class="col-form-label text-xs"></label>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer p-1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pb-2">
                                                    <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                        <div class="card">
                                                            <div class="card-header p-0 ">
                                                                <div class="icon icon-x icon-shape bg-gradient-primary shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                    <i class="material-icons opacity-10">email</i>
                                                                </div>
                                                                <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                    <label for="recipient-email" id="email" class="col-form-label text-xs"></label>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer p-1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <script>
                                $('#exampleModalMessage').on('show.bs.modal', function (event) {
                                    /*var button = $(event.relatedTarget)  // Button that triggered the modal
                                    var recipient = button.data('whatever') // Extract info from data-* attributes
                                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

                                    modal.find('.modal-title').text('New message to ' + recipient)
                                    modal.find('.modal-body input').val(recipient)*/
                                    var button = $(event.relatedTarget)
                                    var whatever = button.data('whatever')
                                    var modal = $(this)

                                    var email = button.data('email')
                                    var doc = button.data('doc')
                                    var numberdoc = button.data('numberdoc')
                                    var city = button.data('city')
                                    var address = button.data('address')

                                    modal.find('.modal-title').text('Detalles ' + whatever)
                                    modal.find('#email').text('' + (email))
                                    modal.find('#doc').text('' + (doc ))
                                    modal.find('#numberdoc').text('N°: ' + (numberdoc ))
                                    modal.find('#city').text('' + (city))
                                    modal.find('#address').text('' + (address))


                                })
                            </script>
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
