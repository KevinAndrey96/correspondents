@extends('layouts.dashboard')
@section('content')
    @if(Session::has('LimitExceeded'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('LimitExceeded') }}
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Transacciones</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            @if(Session::has('mensaje'))
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    {{ Session::get('mensaje') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
                                </div>
                            @endif
                            <table id="my_table" class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Cantidad</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Producto</th>
                                    @hasrole('Administrator')
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Tendero</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Proveedor</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Distribuidor</th>
                                    @endhasrole
                                    @if (Auth::user()->role == 'Shopkeeper')
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Tipo</th>
                                    @endif
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Estado</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Fecha</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $transactions as $transaction )
                                    <tr>
                                        <td class="align-middle text-center text-sm">${{ number_format($transaction->amount, 2, ',', '.') }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->product->product_name }}</td>
                                        @hasrole('Administrator')
                                        <td class="align-middle text-center text-sm">{{ $transaction->shopkeeper->name }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->supplier->name }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->distributor->name }}</td>
                                        @endhasrole
                                        @if (Auth::user()->role == 'Shopkeeper')
                                        <td class="align-middle text-center text-sm">
                                            @if ($transaction->type == 'Deposit')
                                                Depósito
                                            @endif
                                                @if ($transaction->type == 'Withdrawal')
                                                    Retiro
                                                @endif
                                        </td>
                                        @endif
                                        <td class="align-middle text-center text-sm">
                                            @if ($transaction->status == 'hold')
                                                <center>
                                                    <p class="text-center text-dark text-sm p-2" style="background-color:#f5df4d; width:60%; border-radius: 20px;">En espera</p>
                                                </center>
                                            @endif
                                                @if ($transaction->status == 'accepted')
                                                    <center>
                                                        <p class="text-center text-white text-sm p-2" style="background-color:dodgerblue; width:60%;  border-radius: 20px;">Aceptada</p>
                                                    </center>
                                                @endif
                                                @if ($transaction->status == 'successful')
                                                    <center>
                                                        <p class="text-center text-white text-sm p-2" style="background-color:green; width:60%; border-radius: 20px;">Exitosa</p>
                                                    </center>
                                                @endif
                                                @if ($transaction->status == 'failed')
                                                    <center>
                                                        <p class="text-center text-white text-sm p-2" style="background-color:red; width:60%; border-radius: 20px;">Fallida</p>
                                                    </center>
                                                @endif
                                                @if ($transaction->status == 'cancelled')
                                                    <center>
                                                        <p class="text-center text-white text-sm p-2" style="background-color:#58696F; width:60%; border-radius: 20px;">Cancelada</p>
                                                    </center>
                                                @endif
                                            </td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->date }}</td>
                                        @if (Auth::user()->role == 'Supplier' && $transaction->status != 'successful' && $transaction->status != 'failed' && $transaction->status != 'cancelled')
                                            <td class="align-middle text-center text-sm">
                                                <a style="color: darkgreen;" href="/transaction/detail/{{$transaction->id}}" class="btn btn-link px-3 mb-0" onclick="return confirm('¿Está seguro que desea iniciar esta transacción? Recuerde que no podrá deshacer esta acción.')" ><i style="color: darkgreen;" class="material-icons opacity-10">add</i> Iniciar</a>
                                            </td>
                                        @endif
                                        @if (Auth::user()->role == 'Supplier' && isset($id))
                                        <td class="align-middle text-center text-sm">
                                            <a style="color: darkgreen;" href="/transaction/detail/{{$transaction->id}}?detail=yes" class="btn btn-link px-3 mb-0" ><i style="color: darkgreen;" class="material-icons opacity-10">add</i>Detalle</a>
                                        </td>
                                        @endif
                                        @if (Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Administrator' )
                                            <td class="align-middle text-center text-sm">
                                                @if ($transaction->status == 'successful' || $transaction->status == 'failed' || $transaction->status == 'cancelled')
                                                    <a style="color: darkgreen;" href="/transaction/detail/{{$transaction->id}}" class="btn btn-link px-3 mb-0"><i style="color: darkgreen;" class="material-icons opacity-10">add</i> Detalle</a>
                                                @endif
                                                @if ($transaction->status == 'hold')
                                                        <a style="color: red;" href="/transaction/cancel/{{$transaction->id}}" class="btn btn-link px-3 mb-0"><i style="color: red;" class="material-icons opacity-10">cancel</i> Cancelar</a>
                                                    @endif
                                            </td>
                                        @endif
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
