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
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Comisiones</h6>

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
                                <thead class="">
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comisión</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach( $commissions as $commission )
                                <tr>
                                    <td class="align-middle text-center text-sm">{{ $commission->product->product_name}} - {{ ($commission->product->product_type) == 'Deposit' ? 'Depósito' : 'Retiro'}}</td>
                                    <td class="align-middle text-center text-sm">${{ $commission->amount}}</td>
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
                                        "pageLength": 20
                                    });
                                } );
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
