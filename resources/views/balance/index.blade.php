@extends('layouts.dashboard')
@section('content')
    <div class="row mt-4">
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Saldos</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if(Session::has('mensaje'))
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                {{ Session::get('mensaje') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
                            </div>
                        @endif
                        <div class="table-responsive p-0">
                            <table id="my_table" class="table align-items-center mb-0">
                                <thead class="thead-light">
                                <tr>
                                @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Saldos')
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo Actual</th>
                                @endif
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° de Solicitud  </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de Solicitud</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto solicitado</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comentarios</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recibo</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                    @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Saldos')
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gestionar solicitud</th>
                                    @endif

                                </tr>
                                </thead>

                                <tbody>
                                @foreach( $balances as $balance )
                                    <tr>
                                        @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Saldos')
                                            <td class="align-middle text-center text-xs">{{ $balance->user->name}}</td>
                                            <td class="align-middle text-center text-xs">${{number_format($balance->user->balance, 2, ',', '.')}}</td>
                                        @endif
                                        <td class="align-middle text-center text-xs">{{ $balance->id}}</td>
                                        @if($balance->type == 'Deposit')
                                        <td class="align-middle text-center text-xs">Deposito</td>
                                        @elseif($balance->type == 'Withdrawal')
                                        <td class="align-middle text-center text-xs">Retiro por Administrador</td>
                                        @endif
                                        <td class="align-middle text-center text-xs">${{number_format($balance->amount, 2, ',', '.')}}</td>
                                        <td class="align-middle text-center text-xs">{{$balance->date}}</td>
                                        <td class="align-middle text-center text-xs">
                                        @if(is_null($balance->comment))
                                            Sin comentarios
                                        @else
                                            {{$balance->comment}}
                                        @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if(isset($balance->boucher))
                                            <div>
                                                <a class="image-link" href="{{ 'https://corresponsales.asparecargas.net/'.$balance->boucher }}">
                                                    <img style="border: 1px solid #010101;" class="avatar avatar-sm rounded-circle image-link" src="{{ 'https://corresponsales.asparecargas.net/'.$balance->boucher }}" alt="No carga">
                                                </a>
                                            </div>
                                            @else
                                                Sin recibo
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if(is_null($balance->is_valid))
                                                <button class="btn btn-primary btn-sm"disabled style="background-color: lightgoldenrodyellow">Pendiente</button>
                                            @elseif($balance->is_valid == 1)
                                                <button class="btn btn-primary btn-sm"disabled style="background-color: lightgreen">Aceptada</button>
                                            @elseif($balance->is_valid == 0)
                                                <button class="btn btn-primary btn-sm"disabled style="background-color: lightcoral">Rechazada</button>
                                            @endif
                                        </td>
                                            @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Saldos')
                                        <td class="align-middle text-center text-sm">
                                            @if(is_null($balance->is_valid))
                                                <button style="padding: 6px; font-size: 11px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#acceptModal"
                                                    data-id="{{$balance->id}}"
                                                ><a style="color: darkgreen;" ><i style="color: darkgreen;" class="material-icons opacity-10">edit</i> Gestionar</a></button>
                                            @endif

                                        </td>
                                    @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <form id="form-status" name="form-status" method="POST" action="{{ url('/balance/validate/' ) }}">
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
                            <!--Modal-->
                            <div class="modal fade" id="ManageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
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
                                                        @if ($countryName == 'COLOMBIA')
                                                            <img width="60%" class="img-responsive" src="https://corresponsales.asparecargas.net/assets/img/bell.png">
                                                        @endif
                                                            @if ($countryName == 'ECUADOR')
                                                                <img width="60%" class="img-responsive" src="https://transacciones.asparecargas.net/assets/img/bell.png">
                                                            @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8">
                                                    <div class="row jusfify-content-center align-items-center">
                                                        <div class="col-md-12">
                                                            <h2 class="text-center pe-2">¡Tienes una nueva solicitud de saldo!</h2>
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
                                    @if (isset($countBalances))
                                    @if ($countBalances > 0)
                                    const alert = document.getElementById('alert');
                                    const btn = document.getElementById('btn');
                                    const btnModal = document.getElementById('btn-modal');
                                    $("#btn").on('click', function(){
                                        alert.play();
                                    })
                                    $("#btn-modal").on('click', function(){
                                        $('#ManageModal').modal('show');
                                    })
                                    btn.click()
                                    btnModal.click()
                                    @endif
                                    @endif
                                });
                                $(document).ready( function () {
                                    setTimeout("location.reload()", 60000);
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
                                        "pageLength": 15,
                                        "aaSorting": [],
                                        "bDestroy": true
                                    });
                                } );
                            </script>
                            <script>
                                $('#acceptModal').on('show.bs.modal', function (event) {
                                    var button = $(event.relatedTarget)
                                    var uID = button.data('id')
                                    var modal = $(this)
                                    var balance_id = document.getElementById("id");
                                    balance_id.value = uID;
                                })
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
