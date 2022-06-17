@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="/balance" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a>Saldo por usuario</h6>

                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div style="margin: 30px;" class="table-responsive p-0">
                          <table id="my_table" class="table table-striped table-responsive">
                            <thead >
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                <th class="ps-1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rol</th>
                                <th width="100"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">Saldo Actual</th>
                                <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gestionar saldo</th>-->
                            </thead>
                            <tbody>
                            @foreach( $users as $user )
                                <tr>
                                    <td class="align-middle text-sm ps-4">{{ $user->name }}</td>
                                    <td class="align-middle text-sm ps-0">
                                        @if ($user->role == 'Distributor')
                                            Distribuidor
                                        @endif
                                        @if ($user->role == 'Administrator')
                                            Administrador
                                        @endif
                                        @if ($user->role == 'Shopkeeper')
                                             Tendero
                                        @endif
                                        @if ($user->role == 'Supplier')
                                             Proveedor
                                        @endif
                                    </td>
                                    <td class="align-middle text-sm ps-1">{{ $user->balance }}</td>
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
@endsection




