@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href="/transactions" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a>Info. de transacción</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">

                            <form action="{{ url('/transaction/storeClientData') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="shopkeeperID" value="{{$transaction->shopkeeper_id}}" id="shopkeeperID" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="distributorID" value="{{$transaction->distributor_id}}" id="distributorID" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="supplierID" value="{{$transaction->supplier_id}}" id="supplierID" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="productID" value="{{$transaction->product_id}}" id="productID" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="transactionAmount" value="{{$transaction->transaction_amount}}" id="transactionAmount" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="transactionDate" value="{{$transaction->transaction_date}}" id="transactionDate" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="transactionType" value="{{$transaction->transaction_type}}" id="transactionType" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="transactionState" value="{{$transaction->transaction_state}}" id="transactionState" readonly="readonly">
                                    </div>

                                    @if($product->client_name == 1)
                                      <div class="col-md-4">
                                        <h6 style="margin-bottom: -10px;" class="text-sm text-center">Nombre del cliente</h6>
                                        <div class="input-group input-group-outline my-3">
                                            <label for="clientName" ></label>
                                            <input type="text" class="form-control" name="clientName" id="clientName" placeholder="Nombre del cliente">
                                        </div>
                                      </div>
                                    @endif
                                    @if($product->client_document == 1)
                                      <div class="col-md-3">
                                        <h6 style="margin-bottom: -10px;" class="text-sm text-center">N° Documento</h6>
                                        <div class="input-group input-group-outline my-3">
                                            <label for="clientDocument" ></label>
                                            <input type="text" class="form-control" name="clientDocument" id="clientDocument" placeholder="Documento del cliente">
                                        </div>
                                      </div>
                                    @endif
                                    @if($product->email == 1)
                                        <div class="col-md-5">
                                            <h6 style="margin-bottom: -10px;" class="text-sm text-center">Correo electrónico</h6>
                                            <div class="input-group input-group-outline my-3">
                                               <label for="email" ></label>
                                               <input type="email" class="form-control" name="email" value="" id="" placeholder="Correo electrónico">
                                            </div>
                                        </div>
                                    @endif
                                    @if($product->phone_number == 1)
                                        <div class="col-md-3">
                                            <h6 style="margin-bottom: -10px;" class="text-sm text-center">Tel. del cliente</h6>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="phoneNumber" ></label>
                                                <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Teléfono del cliente">
                                            </div>
                                        </div>
                                    @endif
                                    @if($product->account_type == 1)
                                        <div class="col-md-3">
                                            <h6 style="margin-bottom: -10px;" class="text-sm text-center">Tipo de cuenta</h6>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="accountType" ></label>
                                                <input type="text" class="form-control" name="accountType" id="accountType" placeholder="Tipo de cuenta">
                                            </div>
                                        </div>
                                    @endif
                                    @if($product->account_number == 1)
                                        <div class="col-md-3">
                                            <h6 style="margin-bottom: -10px;" class="text-sm text-center">N° de cuenta</h6>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="accountNumber" ></label>
                                                <input type="text" class="form-control" name="accountNumber" id="accountNumber" placeholder="Número de cuenta">
                                            </div>
                                        </div>
                                    @endif
                                    @if($product->code == 1)
                                        <div class="col-md-3">
                                            <h6 style="margin-bottom: -10px;" class="text-sm text-center">Código</h6>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="code" ></label>
                                                <input type="text" class="form-control" name="code" id="code" placeholder="Código">
                                            </div>
                                        </div>
                                    @endif
                                    @if($product->extra == 1)
                                    <div class="col-md-6">
                                            <h6 style="margin-bottom: -10px;" class="text-sm text-center">Info. extra</h6>
                                            <div class="input-group input-group-outline my-3">
                                                <label for="extra" ></label>
                                                <input type="text" class="form-control" name="extra" id="extra" placeholder="Información extra">
                                             </div>
                                        </div>
                                    @endif
                                    <div class="text-center">
                                        <input class="btn btn-success" type="submit" value="Solicitar Transaccion">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
