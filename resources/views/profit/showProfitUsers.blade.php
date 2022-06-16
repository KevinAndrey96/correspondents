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
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">¿validado?</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">¿invalidar/validar?</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subir Recibo</th>
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
                                    <td class="align-middle text-center text-sm">{{$profit->user->profit}}</td>
                                    <td class="align-middle text-center text-sm">{{ $profit->amount }}</td>
                                    <td class="align-middle text-center text-sm">
                                    {{$profit->extra}}
                                    </td>
                                    @if($profit->is_valid == 0)
                                    <td class="align-middle text-center text-sm">No</td>
                                    @else
                                    <td class="align-middle text-center text-sm">Si</td>
                                    @endif
                                    <td class="align-middle text-center text-sm">
                                        <div class="form-check form-switch ">
                                            @if ($profit->is_valid == 1)
                                                <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{$profit->id}}" onclick="return confirm('¿Esta seguro de invalidar la solicitud #{{$profit->id}} por un valor de ${{$profit->amount}} para el usuario {{$profit->user->name}}?')" checked onchange="validate({{$profit->id}})">
                                                <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="togglestatus{{$profit->id}}"></label>
                                            @else
                                                <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{$profit->id}}" onclick="return confirm('¿Esta seguro de validar la solicitud #{{$profit->id}} por un valor de ${{$profit->amount}} para el usuario {{$profit->user->name}}?')" onchange="validate({{$profit->id}})">
                                                <label class="form-check-label text-body ms-0 text-truncate w-0 mb-80" for="togglestatus{{$profit->id}}"></label>
                                            @endif
                                        </div>
                                        <form id="form-status" name="form-status" method="POST" action="{{ url('/profit/validate/' ) }}">
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
                                                var profit_id = document.getElementById("id");

                                                if (toggle.checked == true) {
                                                    status.value = 1;
                                                } else {
                                                    status.value = 0;
                                                }
                                                profit_id.value = id;
                                                form.submit();
                                            }
                                        </script>
                                    </td>
                                    <td class="align-middle text-center text-sm"> <button style="padding: 6px; font-size: 11px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-white" data-bs-toggle="modal"
                                    data-bs-target="#SaldoModal"><a style="color: darkgreen;" ><i style="color: darkgreen;" class="material-icons opacity-10">edit</i> Gestionar</a></button>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <!-- Modal-->
                            <div class="modal fade" id="SaldoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
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
                                                        @if(count($profits)>0)
                                                            <input type="hidden" class="form-control" name="profitID" value="{{$profit->id}}" id="profitID" readonly="readonly">
                                                        @else
                                                            <input type="hidden" class="form-control" name="profitID" value="" id="profitID" readonly="readonly">
                                                        @endif
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
                                                        <input class="btn btn-success" type="submit" value="Gestionar saldo" onclick="return confirm('¿Esta seguro de realizar esta acción?')">

                                                        <a class="btn btn-primary" href="{{ url('/profit/users') }}"> Regresar</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--end Modal-->
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection




