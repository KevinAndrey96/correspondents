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
                        <div class="container">
                            @if(count($errors)>0)
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach( $errors->all() as $error )
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ url('/transaction/store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4 ">
                                            <label  for="">Tipo de transacción</label>
                                            <select id="transactionType" onchange="showProducts()" name="transactionType" class="form-control" aria-label="Default select example" required>
                                                <option class="text-center" value="off">seleccionar</option>
                                                <option class="text-center" value="Deposit">Deposito</option>
                                                <option class="text-center" value="Withdrawal">Retiro</option>
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
                                            }
                                            if (transactionType == 'Withdrawal') {
                                                document.getElementById('withdrawal').style.display = 'block'
                                                document.getElementById('deposit').style.display = 'none'
                                            }
                                            if (transactionType == 'off') {
                                                document.getElementById('withdrawal').style.display = 'none'
                                                document.getElementById('deposit').style.display = 'none'
                                            }

                                        }

                                    </script>
                                    <div class="col-md-6">
                                        <div class=" input-group input-group-outline my-3">
                                            <label for="transactionAmount" class="form-label">Monto</label>
                                            <input type="number" class="form-control" name="transactionAmount" id="transactionAmount" step="1" min="20000" max="200000" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="hidden" class="form-control" name="productID" value="" id="productID" readonly="readonly">
                                    </div>
                                    <div class="col-md-12">
                                            <div id="deposit" style=" display: none;">
                                                <p class="form-label">Depositos</p>
                                                <div class="row">
                                                    @foreach( $productsDeposit as $product )
                                                        <div class="col-md-3 col-xs-6">
                                                        <div class=" form-check mb-3" >
                                                            <input class="form-check-input" type="radio" name="productID" id="productID" value="{{$product->id}}" required>
                                                            <label  class="custom-control-label text-center" for="customRadio1"><img style=" height: auto !important; width: 60px !important;" class="avatar avatar-sm rounded-circle mx-1" src="{{ 'https://corresponsales.asparecargas.net/'.$product->product_logo }}" alt="No carga"><p class="text-xs mt-1">{{ $product->product_name}}</p></label>
                                                        </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div id="withdrawal" style="display: none;">
                                                <p class="form-label">Retiros</p>
                                                <div class="row">
                                                    @foreach( $productsWithdrawal as $product )
                                                    <div class="col-md-3 col-xs-6">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="productID" id="productID" value="{{$product->id}}" required>
                                                        <label class="custom-control-label text-center " for="customRadio1"><img style=" height: auto !important; width: 60px !important;" class="avatar avatar-sm rounded-circle mx-1" src="{{ 'https://corresponsales.asparecargas.net/'.$product->product_logo }}" alt="No carga"><p class="text-xs mt-1">{{ $product->product_name}}</p></label>
                                                    </div>
                                                    </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <input class="btn btn-success" type="submit" value="continuar">
                                        <a class="btn btn-primary" href="{{ url('/transactions') }}"> Regresar</a>
                                    </div>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
