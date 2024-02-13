@extends('layouts.dashboard')
@section('content')
    @if(Session::has('balanceAssigned'))
        <div class="d-flex justify-content-center">
            <div class="alert alert-success w-75" role="alert">
                <p class="text-center text-white">{{ Session::get('balanceAssigned') }}</p>
            </div>
        </div>
    @endif
    <div class="row">
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
                                <table id="tabla1" class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Saldos')
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo Actual</th>
                                        @endif
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° de Solicitud  </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de Solicitud</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto solicitado</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha de solicitud</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha de aceptación de administrador</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comentarios</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recibo</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acción</th>
                                    <tbody>
                                        @foreach( $balances as $balance )
                                            <tr>
                                                @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Saldos')
                                                    <td class="align-middle text-center text-xs">{{$balance->user->name}}</td>
                                                    <td class="align-middle text-center text-xs">${{number_format($balance->user->balance, 2, ',', '.')}}</td>
                                                @endif
                                                    <td class="align-middle text-center text-xs">{{$balance->id}}</td>
                                                    @if ($balance->type == 'Deposit')
                                                        <td class="align-middle text-center text-xs">Deposito</td>
                                                    @elseif ($balance->type == 'Withdrawal')
                                                        <td class="align-middle text-center text-xs">Retiro por Administrador</td>
                                                        @elseif ($balance->type == 'Recharge')
                                                        <td class="align-middle text-center text-xs">Recarga de Saldo</td>
                                                    @endif
                                                    <td class="align-middle text-center text-xs">${{number_format($balance->amount, 2, ',', '.')}}</td>
                                                    <td class="align-middle text-center text-xs">{{$balance->date}}</td>
                                                    <td class="align-middle text-center text-xs">
                                                        @if (isset($balance->admin_date))
                                                            {{$balance->admin_date}}
                                                        @else
                                                            No info
                                                        @endif
                                                    </td>
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
                                                                <a class="image-link" href="{{$urlServer.'/'.$balance->boucher}}">
                                                                    <img style="border: 1px solid #010101;" class="avatar avatar-sm rounded-circle image-link" src="{{$urlServer.'/'.$balance->boucher}}" alt="No carga">
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
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a style="color: darkblue;" href="{{route('balance.detail-pdf', ['id' => $balance->id])}}" target="_blank" title="Imprimir comprobante" class="btn btn-link px-0 mb-0"><i style="color: darkblue;  font-size: 25px !important;" class="material-icons opacity-10">print</i></a>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                "pageLength": 15,
                "aaSorting": [],
                "bDestroy": true
            });
        } );
    </script>

@endsection
