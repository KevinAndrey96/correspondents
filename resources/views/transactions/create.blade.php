@extends('layouts.dashboard')
@section('content')
    @if(Session::has('thereIsNotCommission'))
        <div class="alert alert-danger text-white" role="alert">
            <p class="text-center text-sm text-white">{{ Session::get('thereIsNotCommission') }}</p>
        </div>
    @endif
    @if(Session::has('cancelTransactionSuccess'))
        <div class="alert alert-success text-white" role="alert">
            <p class="text-center text-sm text-white">{{ Session::get('cancelTransactionSuccess') }}</p>
        </div>
    @endif
    @if(Session::has('insufficientBalance'))
        <div class="alert alert-danger text-white" role="alert">
            <p class="text-center text-sm text-white">{{ Session::get('insufficientBalance') }}</p>
        </div>
    @endif
    @if(Session::has('noSuppliers'))
        <div class="alert alert-danger text-white" role="alert">
            <p class="text-center text-sm text-white">{{ Session::get('noSuppliers') }}</p>
        </div>
    @endif
    @if(Session::has('limitExceeded'))
        <div class="alert alert-danger text-white" role="alert">
            <p class="text-center text-sm text-white">{{ Session::get('limitExceeded') }}</p>
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href="/home" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a>Crear transacción</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if(count($errors)>0)
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach( $errors->all() as $error )
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(! $productsDeposit->isNotEmpty())
                            @if(! $productsWithdrawal->isNotEmpty())
                                <script>
                                    alert('No hay productos disponibles');
                                    window.location.href = '/home';
                                </script>
                            @endif
                        @endif
                        <form action="{{ url('/transaction/store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-static mb-4 ">
                                        <label  for="">Tipo de transacción</label>
                                        <select id="transactionType" onchange="showProducts()" name="transactionType" class="form-control" aria-label="Default select example" required>
                                            <option class="text-center" value="off">seleccionar</option>
                                            @if($productsDeposit->isNotEmpty())
                                                <option class="text-center" id="d-op" value="Deposit">Deposito</option>
                                            @endif
                                            @if($productsWithdrawal->isNotEmpty())
                                                <option class="text-center" id="w-op" value="Withdrawal">Retiro</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <script>
                                    function showProducts() {
                                        //al seleccionar el tipo de transacción mostar los productos que correspondan
                                        //si es deposito muestra los productos de deposito y si no muestra los de retiro
                                        //paso 1: saber que seleccionó el cliente
                                        var transactionType = document.getElementById('transactionType').value
                                        //paso 2: mostrar el di que corresponda
                                        if (transactionType == 'Deposit') {
                                            document.getElementById('deposit').style.display = 'block'
                                            document.getElementById('withdrawal').style.display = 'none'
                                            document.getElementById('submitButton').disabled = false
                                            resetRadioButtons("productID");
                                        }
                                        if (transactionType == 'Withdrawal') {
                                            document.getElementById('withdrawal').style.display = 'block'
                                            document.getElementById('deposit').style.display = 'none'
                                            document.getElementById('submitButton').disabled = false
                                            resetRadioButtons("productID");
                                        }
                                        if (transactionType == 'off') {
                                            document.getElementById('withdrawal').style.display = 'none'
                                            document.getElementById('deposit').style.display = 'none'
                                            document.getElementById('submitButton').disabled = true
                                            resetRadioButtons("productID");
                                        }

                                        function resetRadioButtons(groupName) {
                                            var arRadioBtn = document.getElementsByName(groupName);

                                            for (var ii = 0; ii < arRadioBtn.length; ii++) {
                                                var radButton = arRadioBtn[ii];
                                                radButton.checked = false;
                                            }
                                        }
                                    }
                                </script>
                                <div class="col-md-6">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="transactionAmount" class="form-label">Monto</label>
                                        <input type="number" class="form-control" name="transactionAmount" id="transactionAmount" step="any" placeholder="" min="0" required >
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="hidden" class="form-control" name="productID" value="" id="productID" readonly="readonly">
                                </div>
                                <div class="col-md-12">
                                    @if ($platform->is_enabled == 1)
                                    <div id="deposit" style=" display: none;">
                                        <p class="form-label">Depositos</p>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <p class="text-sm text-weight-bold text-center">Click en el logo para más información</p>
                                            </div>
                                            @foreach($productsDeposit as $product)
                                                <div class="col-md-3 col-xs-6">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="productID" id="productID" value="{{$product->id}}" required>
                                                        <label  style="width:50%;" class="custom-control-label text-center" for="customRadio1">
                                                            <button style="padding: 6px; font-size: 11px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#DescriptionModal{{$product->id}}"
                                                                    data-id="{{$product->id}}">
                                                                    <a>
                                                                        <img style=" height: auto !important; width: 60px !important;" class="avatar avatar-sm rounded-circle mx-1" src="{{$urlServer.'/'.$product->product_logo}}" alt="No carga">
                                                                        <p style="overflow-wrap: break-word;" class="text-xs mt-1" >{{ $product->product_name}}</p>
                                                                    </a>
                                                            </button>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="DescriptionModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title" id="exampleModalLabel">Detalle del producto</h6>
                                                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-8">
                                                                        <div class="card">
                                                                            <div class="card-header pb-0 px-3 text-center">
                                                                                <h6 class="mb-0">{{$product->product_name}}</h6>
                                                                            </div>
                                                                            <div class="card-body pt-4 p-3">
                                                                                <div class="d-flex flex-column">
                                                                                        {!! $product->product_description !!}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div id="withdrawal" style="display: none;">
                                        <p class="form-label">Retiros</p>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <p class="text-sm text-weight-bold text-center">Click en el logo para más información</p>
                                            </div>
                                            @foreach( $productsWithdrawal as $product )
                                                <div class="col-md-3 col-xs-6">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="productID" id="productID" value="{{$product->id}}" required>
                                                        <button style="padding: 6px; font-size: 11px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#DescriptionModal{{$product->id}}"
                                                                data-id="{{$product->id}}">
                                                                <a>
                                                                    <img style=" height: auto !important; width: 60px !important;" class="avatar avatar-sm rounded-circle mx-1" src="{{ $urlServer.'/'.$product->product_logo }}" alt="No carga">
                                                                    <p class="text-xs mt-1">{{ $product->product_name}}</p>
                                                                </a>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="DescriptionModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title" id="exampleModalLabel">Detalle del producto</h6>
                                                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                    <div class="row">
                                                                        <div class="col-md-2"></div>
                                                                        <div class="col-md-8">
                                                                            <div class="card">
                                                                                <div class="card-header pb-0 px-3 text-center">
                                                                                    <h6 class="mb-0">{{$product->product_name}}</h6>
                                                                                </div>
                                                                                <div class="card-body pt-4 p-3">
                                                                                    <div class="d-flex flex-column">
                                                                                        {!! $product->product_description !!}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                        <input class="btn btn-success" type="submit" id="submitButton" disabled value="continuar">
                                        <a class="btn btn-primary" href="{{ url('/transactions') }}"> Regresar</a>
                                    </div>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!--MODAL-->

@endsection
