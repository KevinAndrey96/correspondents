@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 ">Transacciones <a href="/transaction/create/4" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">currency_exchange</i></a></h6>

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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Tendero</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Distribuidor</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Proveedor</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Producto</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Cliente</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Documento Cliente</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Cantidad</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Fecha</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Tipo de Transaccion</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Estado de Transaccion</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Extras</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $transactions as $transaction )
                                    <tr>
                                        <td class="align-middle text-center text-sm">{{ $transaction->shopkeeper_id }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->distributor_id }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->supplier_id }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->product_id }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->client_name }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->client_document }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->amount }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->date }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->type }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->status }}</td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->detail }}</td>
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
