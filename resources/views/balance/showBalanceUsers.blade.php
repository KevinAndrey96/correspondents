@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="/balance" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a> Gestión de saldo </h6>

                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                          <table id= "my_table"  class="table align-items-center mb-0">
                            <thead >
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rol</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo Actual</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gestionar saldo</th>
                            </thead>
                            <tbody>
                            @foreach( $users as $user )
                                <tr>
                                    <td class="align-middle text-center text-sm">{{ $user->name }}</td>
                                    <td class="align-middle text-center text-sm">{{ $user->role }}</td>
                                    <td class="align-middle text-center text-sm">{{ $user->balance }}</td>
                                    <td class="align-middle text-center text-sm"> <button style="padding: 6px; font-size: 11px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-white" data-bs-toggle="modal"
                                    data-bs-target="#SaldoModal"><a style="color: darkgreen;" ><i style="color: darkgreen;" class="material-icons opacity-10">edit</i> Editar</a></button>
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
                                                        <input type="hidden" class="form-control" name="userID" value="{{$user->id}}" id="productID" readonly="readonly">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-static mb-4">
                                                            <label class="" for="">Tipo de transacción</label>
                                                            <select id="type" name="type" class="form-control" aria-label="Default select example">
                                                                <option class="text-center" value="">Seleccionar</option>
                                                                <option class="text-center" value="Deposit">Depósito</option>
                                                                <option class="text-center" value="Withdrawal">Retiro</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-outline my-3">
                                                            <label for="amount"></label>
                                                            <input type="number" class="form-control" name="amount" value="" id="amount" step="100" min="20000.0" max="200000.0" placeholder="Monto">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="p-3">
                                                            <label for="image" > Recibo </label>
                                                            @if(isset($balance->boucher))
                                                            <img class="img-thumbnail img-fluid" src="{{ 'https://corresponsales.asparecargas.net/'.$balance->boucher }}" width="100" alt = "No carga">
                                                            @endif
                                                            <input style="border: gray 0.5px solid; border-radius: 20px" type="file" class="form-control form-control-sm" name="image" value="" id="image">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <input class="btn btn-success" type="submit" value="Gestionar saldo">

                                                        <a class="btn btn-primary" href="{{ url('/balance/users') }}"> Regresar</a>
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




