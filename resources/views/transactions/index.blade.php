@extends('layouts.dashboard')
@section('content')
    @if(Session::has('LimitExceeded'))
        <div class="alert alert-danger text-white text-center" role="alert">
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
                                    @hasrole('Administrator')
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Tipo</th>
                                    @endhasrole
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Producto</th>
                                    @hasanyrole('Administrator|Supplier')
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Tendero</th>
                                    @endhasanyrole
                                    @hasrole('Administrator')
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
                                        @hasrole('Administrator')
                                        <td class="align-middle text-center text-sm">
                                            @if ($transaction->type == 'Deposit')
                                                Depósito
                                            @else
                                                Retiro
                                            @endif
                                        </td>
                                        @endhasrole
                                        <td class="align-middle text-center text-sm">{{ $transaction->product->product_name }}</td>
                                        @hasanyrole('Administrator|Supplier')
                                        <td class="align-middle text-center text-sm">{{ $transaction->shopkeeper->name }}</td>
                                        @endhasanyrole
                                        @hasrole('Administrator')
                                        <td class="align-middle text-center text-sm">
                                            @if (isset($transaction->supplier))
                                                {{ $transaction->supplier->name }}
                                            @endif
                                        </td>
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
                                                    <p class="text-center text-dark text-xxs p-1" style="background-color:#f5df4d; width:80%; border-radius: 20px;">En espera</p>
                                                </center>
                                            @endif
                                                @if ($transaction->status == 'accepted')
                                                    <center>
                                                        <p class="text-center text-white text-xxs p-1" style="background-color:dodgerblue; width:80%;  border-radius: 20px;">Aceptada</p>
                                                    </center>
                                                @endif
                                                @if ($transaction->status == 'successful')
                                                    <center>
                                                        <p class="text-center text-white text-xxs p-1" style="background-color:green; width:80%; border-radius: 20px;">Exitosa</p>
                                                    </center>
                                                @endif
                                                @if ($transaction->status == 'failed')
                                                    <center>
                                                        <p class="text-center text-white text-xxs p-1" style="background-color:red; width:80%; border-radius: 20px;">Fallida</p>
                                                    </center>
                                                @endif
                                                @if ($transaction->status == 'cancelled')
                                                    <center>
                                                        <p class="text-center text-white text-xxs p-1" style="background-color:#58696F; width:80%; border-radius: 20px;">Cancelada</p>
                                                    </center>
                                                @endif
                                            </td>
                                        <td class="align-middle text-center text-sm">{{ $transaction->created_at }}</td>
                                        @if (Auth::user()->role == 'Supplier' && $transaction->status != 'successful' && $transaction->status != 'failed' && $transaction->status != 'cancelled')
                                            <td class="align-middle text-center text-sm">
                                                <a style="color: darkgreen;" href="/transaction/detail/{{$transaction->id}}" class="btn btn-link px-3 mb-0" onclick="return confirm('¿Está seguro que desea iniciar esta transacción? Recuerde que no podrá deshacer esta acción.')" ><i style="color: darkgreen;" class="material-icons opacity-10">add</i> Iniciar</a>
                                            </td>
                                        @endif
                                        @if (Auth::user()->role == 'Supplier' && isset($id))
                                        <td class="align-middle text-center text-sm">
                                            <a style="color: darkgreen;" href="/transaction/detail/{{$transaction->id}}?detail=yes" title="Detalle" class="btn btn-link px-3 mb-0" ><i style="color: darkgreen;" class="material-icons opacity-10">add</i></a>
                                        </td>
                                        @endif
                                        @if (Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Administrator' )
                                            <td class="align-middle text-center text-sm">
                                                @if ($transaction->status == 'successful' || $transaction->status == 'failed' || $transaction->status == 'cancelled')
                                                    <a style="color: darkgreen;" href="/transaction/detail/{{$transaction->id}}" title="Detalle" class="btn btn-link px-3 mb-0"><i style="color: darkgreen;" class="material-icons opacity-10">add</i></a>
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
                                                        <img width="60%" class="img-responsive" src="https://corresponsales.asparecargas.net/assets/img/bell.png">
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8">
                                                    <div class="row jusfify-content-center align-items-center">
                                                        <div class="col-md-12">
                                                            <h2 class="text-center">¡Tienes una nueva transacción!</h2>
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
                                @if (isset($countTransactions))
                                    @if ($countTransactions > 0)
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

                                @if (! isset($id))
                                    setTimeout("location.reload()", 30000);
                                @elseif ($id == 'record')
                                        setTimeout("location.reload()", 30000);
                                @endif

                                $('#my_table').DataTable({
                                    "language": {
                                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                                    },
                                    responsive: true,
                                    "pageLength": 20
                                });
                                $(document).ready(function() {
                                    $('#my_table').DataTable(
                                        {
                                            "language": {
                                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                                                "paginate": {
                                                    "first": "Primero",
                                                    "last": "Último",
                                                    "next": "=>",
                                                    "previous": "<="
                                                }
                                            },
                                            //"bSort" : false,
                                            "aaSorting": [],
                                            "bDestroy": true
                                        });
                                });
                            } );


                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
