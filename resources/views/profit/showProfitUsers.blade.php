@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="/profit" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a> Gestión de Ganancia </h6>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                          <table id= "my_table"  class="table align-items-center mb-0">
                            <thead >
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rol</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ganancia acumulada</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">monto a retirar</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Extra</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">¿Aceptado?</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comentarios</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                            </thead>
                            <tbody>
                            @foreach( $profits as $profit )
                                <tr>
                                    <td class="align-middle text-center text-sm">{{ $profit->id }}</td>
                                    <td class="align-middle text-center text-sm">{{ $profit->user->name }}</td>
                                    <td class="align-middle text-center text-sm">
                                        @if ($profit->user->role == 'Distributor')
                                            Distribuidor
                                        @endif
                                        @if ($profit->user->role == 'Administrator')
                                            Administrador
                                        @endif
                                        @if ($profit->user->role == 'Shopkeeper')
                                            Tendero
                                        @endif
                                        @if ($profit->user->role == 'Supplier')
                                            Proveedor
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">${{number_format($profit->user->profit, 2, ',', '.')}}</td>
                                    <td class="align-middle text-center text-sm">${{number_format($profit->amount, 2, ',', '.')}}</td>
                                    <td class="align-middle text-center text-sm">
                                    {{$profit->extra}}
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if(is_null($profit->is_valid))
                                            En espera
                                        @else
                                            @if($profit->is_valid == 1)
                                                    Si
                                                @else
                                                    No
                                                @endif
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if(is_null($profit->comment))
                                            Sin comentarios
                                        @else
                                            {{$profit->comment}}
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <button style="padding: 6px; font-size: 11px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#boucherModal"
                                            data-id="{{$profit->id}}"
                                        ><a style="color: darkgreen;" >Recibo</a></button>
                                        @if(is_null($profit->is_valid))
                                            <button style="padding: 6px; font-size: 11px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#acceptModal"
                                                data-id="{{$profit->id}}"
                                            ><a style="color: darkgreen;" ><i style="color: darkgreen;" class="material-icons opacity-10">edit</i> Gestionar</a></button>
                                        @endif
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
                                    $('#my_table').DataTable({
                                        "language": {
                                            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                                        },
                                        responsive: true,
                                        "pageLength": 20,
                                        order: [[1, 'desc']]
                                    });
                                } );
                            </script>
                        <form id="form-status" name="form-status" method="POST" action="{{ url('/profit/validate/' ) }}">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="status" id="status">
                            <input type="hidden" name="comment" id="comment">
                        </form>
                        <script>
                            function validate(type)
                            {
                                var status = document.getElementById("status");
                                var form = document.getElementById("form-status");

                                if (type == 'accepted') {
                                    status.value = 1;
                                } else {
                                    status.value = 0;
                                }
                                form.submit();
                            }
                            function comment()
                            {
                                var comment = document.getElementById("comment");
                                comment.value = document.getElementById("commentModal").value;
                            }
                        </script>
                        <!-- Modal-->
                        <div class="modal fade" id="boucherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Validar Ganancia</h6>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/profit') }}" method="post" enctype="multipart/form-data">
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
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="profitID" value="" id="profitID" readonly="readonly">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="p-3">
                                                        <label for="image" > Recibo </label>
                                                        @if(isset($profit->boucher))
                                                        <img class="img-thumbnail img-fluid" src="{{ 'https://corresponsales.asparecargas.net/'.$profit->boucher }}" width="100" alt = "No carga">
                                                        @endif
                                                        <input style="border: gray 0.5px solid; border-radius: 20px" type="file" class="form-control form-control-sm" name="image" value="" id="image">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <input class="btn btn-success" type="submit" value="Gestionar saldo" onclick="return confirm('¿Está seguro de realizar esta acción?')">

                                                    <a class="btn btn-primary" href="{{ url('/profit/users') }}"> Regresar</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--end Modal-->
                        <script>
                            $('#boucherModal').on('show.bs.modal', function (event) {
                                var button = $(event.relatedTarget)
                                var pID = button.data('id')
                                var modal = $(this)

                                modal.find('.modal-body #profitID').val(pID)
                            })
                        </script>
                        <!-- Modal-->
                        <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLabel">Gestionar solicitud</h6>
                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label"></label>
                                            <input type="text" class="form-control" name="commentModal" id="commentModal" placeholder="Comentario" onchange = "comment()">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <a style="color: green;" class="btn btn-link px-3 mb-0" id="acceptstatus" onclick="validate('accepted')">Aceptar</a>
                                            </div>
                                            <div class="col-md-6">
                                            <a style="color: red;" class="btn btn-link px-3 mb-0" id="acceptstatus" onclick="validate('rejected')">Rechazar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end Modal-->
                        <script>
                            $('#acceptModal').on('show.bs.modal', function (event) {
                                var button = $(event.relatedTarget)
                                var pID = button.data('id')
                                var modal = $(this)
                                var profit_id = document.getElementById("id");
                                profit_id.value = pID;
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




