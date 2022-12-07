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
                                            @if (is_null($profit->is_valid))
                                            <button style="padding: 6px; font-size: 11px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#ManageModal"
                                                    data-id="{{$profit->id}}"
                                            ><a style="color: darkgreen;" ><i style="color: darkgreen;" class="material-icons opacity-10"></i> Gestionar</a></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!--Modal-->
                            <div class="modal fade" id="AlertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!--<h6 class="modal-title" id="exampleModalLabel">Gestionar ganancias</h6>-->
                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="row jusfify-content-center align-items-center">
                                                        <img width="60%" class="img-responsive" src="https://testing.asparecargas.net/assets/img/bell.png">
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8">
                                                    <div class="row jusfify-content-center align-items-center">
                                                        <div class="col-md-12">
                                                            <h2>¡Tienes una nueva solicitud de retiro de ganancias!</h2>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end Modal-->
                            <audio id="alert" style="display: none;" src="/assets/alerts/SD_ALERT_3.mp3"
                                   controls>
                                Your browser does not support the <code>audio</code> element.
                            </audio>
                            <input type="button" style="display:none" id="btn" value="reproducir">
                            <input type="button" style="display:none" id="btn-modal" value="reproducir">
                            <style>
                                .form-control {
                                    background-color: #f2f2f2 !important ;
                                }
                            </style>
                            <script>
                                window.addEventListener("load", function(event) {
                                    @if (isset($countProfits))
                                        @if ($countProfits > 0)
                                            const alert = document.getElementById('alert');
                                            const btn = document.getElementById('btn');
                                            const btnModal = document.getElementById('btn-modal');
                                            $("#btn").on('click', function(){
                                                alert.play();
                                            })
                                            $("#btn-modal").on('click', function(){
                                                $('#AlertModal').modal('show');
                                            })
                                            btn.click()
                                            btnModal.click()
                                        @endif
                                    @endif
                                });
                                $(document).ready( function () {
                                    setTimeout("location.reload()", 30000);
                                    $('#my_table').DataTable({
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
                                            "pageLength": 20
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
                            <div class="modal fade" id="ManageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLabel">Gestionar ganancias</h6>
                                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/profit" method="post" enctype="multipart/form-data">
                                               @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group input-group-static mb-4">
                                                            <label class="" for="">La solicitud sera: </label>
                                                            <select id="type" name="status" class="form-control" aria-label="Default select example" required>
                                                                <option class="text-center" value="accepted">Aceptada</option>
                                                                <option class="text-center" value="rejected">Rechazada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="name" class="form-label">Comentario:</label>
                                                        <input type="text" class="form-control" name="comment" id="comment" placeholder="Comentario">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="p-3">
                                                            <label for="image" > Recibo (Opcional) </label>
                                                            <input style="border: gray 0.5px solid; border-radius: 20px" type="file" class="form-control form-control-sm" name="image" value="" id="image">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="form-control" name="profitID" value="" id="profitID" readonly="readonly">
                                                    <div class="col-md-12 text-center">
                                                        <input class="btn btn-success" type="submit" value="Gestionar" onclick="return confirm('¿Está seguro de realizar esta acción?')">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--end Modal-->
                            <script>
                                $('#ManageModal').on('show.bs.modal', function (event) {
                                    var button = $(event.relatedTarget)
                                    var mID = button.data('id')
                                    var modal = $(this)

                                    modal.find('.modal-body #profitID').val(mID)
                                })
                            </script>
                            <script>
                                $('#acceptModal').on('show.bs.modal', function (event) {
                                    var button = $(event.relatedTarget)
                                    var pID = button.data('id')
                                    var modal = $(this)
                                    var profit_id = document.getElementById("id");
                                    profit_id.value = pID;
                                })
                                $(document).ready(function() {
                                    $('#my_table').DataTable(
                                        {
                                            //"bSort" : false,
                                            "aaSorting": [],
                                            "bDestroy": true
                                        });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

