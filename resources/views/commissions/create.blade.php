@extends('layouts.dashboard')
@section('content')
    <div class="row mt-4"></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-3">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
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
                        <table class="table align-items-center mb-3">
                            <thead thead-light>
                                <tr>
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
                                @foreach ($commissions as $commission)
                                    <tr>
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
                                                   step="0.01" min="0.01">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            <div class="text-center p-1">
                                <input type="hidden" name="amounts" id="amounts">
                                <input type="hidden" name="ids" id="ids">
                                <input class="btn btn-primary" type="submit" value="Modificar">
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
                </div>
            </div>
        </div>
    </div>
@endsection
