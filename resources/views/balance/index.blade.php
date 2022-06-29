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
                                @hasrole('Administrator')
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo Actual</th>
                                @endhasrole
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° de Solicitud  </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de Solicitud</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto solicitado</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comentarios</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recibo</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                @hasrole('Administrator')
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gestionar solicitud</th>
                                @endhasrole

                                </tr>
                                </thead>

                                <tbody>
                                @foreach( $balances as $balance )
                                    <tr>
                                    @hasrole('Administrator')
                                        <td class="align-middle text-center text-sm">{{ $balance->user->name}}</td>
                                        <td class="align-middle text-center text-sm">{{ $balance->user->balance}}</td>
                                    @endhasrole
                                        <td class="align-middle text-center text-sm">{{ $balance->id}}</td>
                                        @if($balance->type == 'Deposit')
                                        <td class="align-middle text-center text-sm">Deposito</td>
                                        @elseif($balance->type == 'Withdrawal')
                                        <td class="align-middle text-center text-sm">Retiro por Administrador</td>
                                        @endif
                                        <td class="align-middle text-center text-sm">{{ $balance->amount}}</td>
                                        <td class="align-middle text-center text-sm">{{ $balance->date}}</td>
                                        <td class="align-middle text-center text-sm">
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
                                            @if($balance->is_valid == 1)
                                                <button class="btn btn-primary"disabled style="background-color: lightgreen">Aceptada</button>
                                            @elseif($balance->is_valid == 0)
                                                <button class="btn btn-primary"disabled style="background-color: lightcoral">Rechazada</button>
                                            @else
                                                <button class="btn btn-primary"disabled style="background-color: lightgoldenrodyellow">Pendiente</button>
                                            @endif
                                        </td>
                                    @hasrole('Administrator')
                                        <td class="align-middle text-center text-sm">
                                            @if(is_null($balance->is_valid))
                                                <button style="padding: 6px; font-size: 11px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#acceptModal"
                                                    data-id="{{$balance->id}}"
                                                ><a style="color: darkgreen;" ><i style="color: darkgreen;" class="material-icons opacity-10">edit</i> Gestionar</a></button>
                                            @endif

                                        </td>
                                    @endhasrole
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
