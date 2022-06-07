@extends('layouts.dashboard')
@section('content')
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
                                            <option class="text-center" value="">seleccionar</option>
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

                                        }

                                    </script>
                                <div class="col-md-6">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="transactionAmount" class="form-label">Monto</label>
                                        <input type="number" class="form-control" name="transactionAmount" id="transactionAmount" step="1" min="20000" max="200000" placeholder="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="productID" value="" id="productID" readonly="readonly">
                                </div>

                                <div class="col-md-12" id="deposit" style="display: none;">
                                    <label class="form-label">Depositos</label>
                                    <div class="form-check mb-3">
                                        @foreach( $productsDeposit as $product )
                                            <input class="form-check-input" type="radio" name="productID" id="productID" value="{{$product->id}}" required>
                                            <label style="margin-right: 50px;" class="custom-control-label" for="customRadio1"><img style="margin-right: 10px;" class="avatar avatar-sm rounded-circle " src="{{ 'https://corresponsales.asparecargas.net/'.$product->product_logo }}" alt="No carga">{{ $product->product_name}}</label>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-12" id="withdrawal" style="display: none;">
                                    <label class="form-label">Retiros</label>
                                    <div class="form-check mb-3">
                                        @foreach( $productsWithdrawal as $product )
                                            <input class="form-check-input" type="radio" name="productID" id="productID" value="{{$product->id}}" required>
                                            <label class="custom-control-label" for="customRadio1"><img  class="avatar avatar-sm rounded-circle " src="{{ 'https://corresponsales.asparecargas.net/'.$product->product_logo }}" alt="No carga">{{ $product->product_name}}</label>
                                        @endforeach
                                    </div>
                                </div>

                                <!--<div class="col-md-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1">
                                        <label class="custom-control-label" for="customRadio1"><img src="https://artesla.com.co/wp-content/uploads/2021/01/nequi-logo.png" height="80px" width="80px" ></label>
                                    </div>
                               </div>
                                <div class="col-md-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1">
                                        <label class="custom-control-label" for="customRadio1"><img src="https://www.bancolombia.com/wps/wcm/connect/16a1f742-cf9f-4b5d-ac06-d7845c05d88e/logo-grupo-bancolombia.png?MOD=AJPERES&CACHEID=ROOTWORKSPACE-16a1f742-cf9f-4b5d-ac06-d7845c05d88e-nAfNfta" height="80px" width="160px" ></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1">
                                        <label class="custom-control-label" for="customRadio1"><img src="https://cdn.worldvectorlogo.com/logos/daviplata.svg" height="80px" width="80px" ></label>
                                    </div>
                                </div>-->

                                    <div class="text-center">
                                        <input class="btn btn-success" type="submit" value="continuar">

                                        <a class="btn btn-primary" href="{{ url('/transactions') }}"> Regresar</a>
                                   </div>
                               </div>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
