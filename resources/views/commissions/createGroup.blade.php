@extends('layouts.dashboard')
@section('content')
    @if (Session::has('noChecked'))
        <div class="alert alert-danger" role="alert">
            <p class="text-center text-white">{{ Session::get('noChecked') }}</p>
        </div>
    @endif
    @if (Session::has('notAllowedAmount'))
        <div class="alert alert-danger" role="alert">
            <p class="text-center text-white">{{ Session::get('notAllowedAmount') }}</p>
        </div>
    @endif
    @if (Session::has('systemError'))
        <div class="alert alert-danger" role="alert">
            <p class="text-center text-white">{{ Session::get('systemError') }}</p>
        </div>
    @endif

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        @if (isset(Auth::user()->brand_id))
                        <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="{{route('commissions.groups')}}" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a>Crear grupo de comisiones</h6>
                        </div>
                        @else
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="{{route('commissions.groups')}}" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a>Crear grupo de comisiones</h6>
                            </div>
                        @endif
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="{{route('commissions.store-group')}}" enctype="multipart/form-data">
                                <div class="row justify-content-center mb-4">
                                    <div class="col-md-11 mt-3">
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Nombre</label>
                                            <input id="name" type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    @csrf
                                    @if (Auth::user()->role == 'Distributor')
                                        <p style="font-size: 20px;" class="font-weight-bold ms-2 mt-3">Seleccione las comisiones:</p>
                                        @foreach($commissions as $commission)
                                            @if (isset($commission->product->is_deleted) && ! $commission->product->is_deleted && isset($commission->product->is_enabled) && $commission->product->is_enabled &&
                                            $commission->amount > 0)
                                            <div class="col-md-4 form-check mt-4 mx-auto">
                                                <div style="border: 4px solid blue" class="w-100 pb-2">
                                                    <div class="w-80 ms-auto me-auto">
                                                        <div class="row">
                                                            <div class="col-md-12 px-1">
                                                                <p class="text-center font-weight-bold">
                                                                    {{strtoupper($commission->product->product_name)}} -
                                                                    @if ($commission->product->product_type == 'Deposit')
                                                                        DEPOSITO
                                                                    @else
                                                                        RETIRO
                                                                    @endif
                                                                </p>
                                                                <p class="text-center">
                                                                    COMISIÓN DISTRIBUIDOR = ${{number_format($commission->amount, 2, ',', '.')}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="w100 ms-auto me-auto">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-2 col-xs-3 text-center my-2 align-items-center">
                                                            <input type="checkbox" class="form-check-input"
                                                                   id="product{{$commission->product->id}}"
                                                                   name="products[]" value="{{$commission->product->id}}"
                                                                   onchange="enableInput({{$commission->product->id}})">
                                                        </div>
                                                        <div class="col-md-4 col-xs-3 rounded">
                                                            <div class="input-group input-group-outline mb-3">
                                                                <label class="form-label">Tendero</label>
                                                                <input style="border: 2px solid #E1D8D6" class="form-control
                                                                text-center w-100" id="amountShop{{$commission->product->id}}" step="0.01"
                                                                       min="0" max="{{$commission->amount}}" type="number" name="amountsShop[]" value="0" disabled>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="amountsDis[]" id="amountDis{{$commission->product->id}}" value="{{$commission->amount}}" disabled>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row mt-4 mb-4">
                                    <div class="col-md-12 mt-3 d-flex justify-content-center">
                                        @if (isset(Auth::user()->brand_id))
                                            <input style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" type="submit" class="btn text-white m-4 float-end" value="Crear">
                                        @else
                                            <input type="submit" class="btn btn-success bg-gradient m-4 float-end" value="Crear">
                                        @endif
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function enableInput(productID)
        {
            console.log(productID);

            let productCheck = document.getElementById('product'+productID);
            let amountDisInput = document.getElementById('amountDis'+productID);
            let amountShopInput = document.getElementById('amountShop'+productID);

            amountShopInput.disabled = true;
            amountDisInput.disabled = true;

            if (productCheck.checked == true) {
                amountShopInput.disabled = false;
                amountDisInput.disabled = false;
            }
        }

    </script>
@endsection
