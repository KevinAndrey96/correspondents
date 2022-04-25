@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 ">Balance<a href="{{ url('balance/create/1') }}" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">add_card</i></a></h6>

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
                            <table id= "my_table" class="table align-items-center mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo Actual</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"># de Solicitud  </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de Solicitud</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto solicitado</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">¿Es Valido?</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recibo</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">invalidar/validar</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach( $balances as $balance )
                                    <tr>
                                        <td>{{ $balance->user->name}}</td>
                                        <td>{{ $balance->user->balance}}</td>
                                        <td>{{ $balance->id}}</td>
                                        @if($balance->type == 'Deposit')
                                        <td>Deposito</td>
                                        @elseif($balance->type == 'Withdrawal')
                                        <td>Retiro</td>
                                        @elseif($balance->type == 'Recharge')
                                        <td>Recarga directa</td>
                                        @endif
                                        <td>{{ $balance->amount}}</td>
                                        <td>{{ $balance->date}}</td>
                                        @if($balance->is_valid == 0)
                                        <td>No</td>
                                        @else
                                        <td>Si</td>
                                        @endif
                                        <td>default.png</td>
                                        <td>
                                            <!--<a href="{{ url('/balance/'.$balance->id.'/edit') }}" class="btn btn-warning"> Editar saldo</a>
                                            <form action="{{ url('/balance/'.$balance->id ) }}" class="d-inline" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger"onclick="return confirm('¿Quieres borrar?')"> Borrar saldo</button>
                                            </form>-->
                                            <div class="form-check form-switch ">
                                            @if ($balance->is_valid == 1)
                                                    <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{$balance->id}}" checked onchange="validate({{$balance->id}})">
                                                    <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="togglestatus{{$balance->id}}"></label>
                                                @else
                                                    <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{$balance->id}}" onchange="validate({{$balance->id}})">
                                                    <label class="form-check-label text-body ms-0 text-truncate w-0 mb-80" for="togglestatus{{$balance->id}}"></label>
                                                @endif
                                            </div>
                                            <form id="form-status" name="form-status" method="POST" action="{{ url('/balance/validate/' ) }}">
                                                @csrf
                                                <input type="hidden" name="id" id="id">
                                                <input type="hidden" name="status" id="status">
                                            </form>
                                            <script>
                                                function validate(id)
                                                {
                                                    var toggle = document.getElementById("togglestatus"+id);
                                                    var status = document.getElementById("status");
                                                    var form = document.getElementById("form-status");
                                                    var balance_id = document.getElementById("id");

                                                    if (toggle.checked == true) {
                                                        status.value = 1;
                                                    } else {
                                                        status.value = 0;
                                                    }
                                                    balance_id.value = id;
                                                    form.submit();
                                                }
                                            </script>   
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
@endsection
