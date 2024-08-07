@extends('layouts.dashboard')
@section('content')
    @if(Session::has('UpdaCommissionFailed'))
        <div class="alert alert-danger" role="alert">
            <p class="text-center text-sm text-white">{{ Session::get('UpdaCommissionFailed') }}</p>
        </div>
    @endif
    @if(Session::has('noCommissions'))
        <div class="alert alert-danger" role="alert">
            <p class="text-center text-sm text-white">{{ Session::get('noCommissions') }}</p>
        </div>
    @endif
    @if(Session::has('UpdaCommissionSuccess'))
        <div class="alert alert-success" role="alert">
            <p class="text-center text-sm text-white">{{ Session::get('UpdaCommissionSuccess') }}</p>
        </div>
    @endif
    <div class="row mt-4"></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-3">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        @if (Auth::user()->role == 'Distributor' && isset(Auth::user()->brand_id))
                        <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            @else
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                @endif
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Comisiones para el
                                @if ($user->role == 'Shopkeeper')
                                    tendero
                                @endif
                                @if ($user->role == 'Distributor')
                                    distribuidor
                                @endif
                                @if ($user->role == 'Supplier')
                                    proveedor
                                @endif
                                {{$user->name}}
                            </h6>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                      <div class="table-responsive p-0">
                        <form method="POST" action="/commissions/update">
                            @csrf
                        <table  id="my_table" class="table align-items-center mb-3">
                            <thead thead-light>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de producto</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                                    @if (Auth::user()->role == 'Distributor')
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comisión distribuidor</th>
                                    @endif
                                    @if (Auth::user()->role == 'Administrator')
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comisión general</th>
                                    @endif
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comisión particular</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userProducts as $userProduct)
                                        @foreach ($commissions as $commission)
                                            @if (isset($commission->product) && ($commission->product_id == $userProduct->product_id))
                                            <tr>
                                                <td class="align-middle text-center text-sm">
                                                    @if($commission->product->product_type == 'Deposit')
                                                        Deposito
                                                    @endif
                                                    @if($commission->product->product_type == 'Withdrawal')
                                                        Retiro
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center text-sm">{{$commission->product->product_name}}</td>
                                                @if (Auth::user()->role == 'Distributor')
                                                <td class="align-middle text-center text-sm">
                                                    @foreach ($commission->user->distributor->commissions as $distCommission)
                                                            @if ($distCommission->product_id == $commission->product->id)
                                                                {{ $distCommission->amount }}
                                                                @break
                                                            @endif
                                                    @endforeach
                                                </td>
                                                @endif
                                                @if (Auth::user()->role == 'Administrator')
                                                    <td class="align-middle text-center text-sm">{{$commission->product->product_commission}}</td>
                                                @endif
                                                <td class="align-middle text-center text-sm">{{$commission->amount}}</td>
                                                <td class="align-middle text-center text-sm">
                                                    <div class="input-group input-group-lg input-group-outline">
                                                    <input class="form-control form-control-lg" type="number" id="amount{{$commission->id}}"
                                                           onclick="amountChange({{ $commission->id }})"
                                                           step="any" min="0">
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                            </tbody>
                        </table>
                            <div class="text-center p-1">
                                <input type="hidden" name="amounts" id="amounts">
                                <input type="hidden" name="ids" id="ids">
                                @if (Auth::user()->role == 'Distributor' && isset(Auth::user()->brand_id))
                                    <input style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="btn btn-primary" type="submit" value="Modificar">
                                @else
                                    <input class="btn btn-primary" type="submit" value="Modificar">
                                @endif
                            </div>
                        </form>
                        <script type="text/javascript">
                            var amounts = new Array();
                            var ids = new Array();

                            function amountChange(commissionID){
                                var inputAmount = document.getElementById('amount'+commissionID);
                                var inputAmounts = document.getElementById('amounts');
                                var inputIDS = document.getElementById('ids');
                                inputAmount.addEventListener('blur',function(){
                                    if (! ids.includes(commissionID))
                                    {
                                        ids.push(commissionID);
                                        index = ids.indexOf(commissionID);
                                        amounts[index] = inputAmount.value;
                                    } else {
                                        index = ids.indexOf(commissionID);
                                        amounts[index] = inputAmount.value;
                                    }
                                    inputAmounts.value = amounts;
                                    inputIDS.value = ids;
                                });
                            }
                        </script>
                      </div>
                        <style>
                            .form-control {
                                background-color: #f2f2f2 !important ;
                            }
                        </style>
                        <script>
                            $(document).ready( function () {
                                $('#my_table').DataTable({
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
                                    "pageLength": 20
                                });
                            } );
                        </script>
                </div>
            </div>
        </div>
    </div>
@endsection
