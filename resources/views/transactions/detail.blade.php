@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg  pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3"></a>Detalles de transacción</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-4">
                        <div class="row">
                            <div class="col-md-2 mt-1"></div>
                            <div class="col-md-7 mt-1">
                                <div class="card bg-primary">
                                    <div class="card-body pt-2 p-2">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 d-flex p-4 mb-0 bg-gray-100 border-radius-lg">
                                              <div class="row">
                                                @if (Auth::user()->role == 'Supplier' && is_null($detailSupplier))
                                                <div class="col-md-4 d-flex flex-column ">
                                                    <h6 class="mb-3 text-sm">Información</h6>
                                                    <p class="mb-2 text-xs font-weight-bold text-dark">Producto: {{$transaction->product->product_name}}</p>
                                                    <p class="mb-2 text-xs font-weight-bold text-dark">Número de cuenta: {{$transaction->account_number}}</p>
                                                    <p class="mb-2 text-xs font-weight-bold text-dark">
                                                        @if ($transaction->type == 'Withdrawal')
                                                            Tipo de transacción: Retiro
                                                        @endif
                                                            @if ($transaction->type == 'Deposit')
                                                                Tipo de transacción: Depósito
                                                            @endif
                                                    </p>
                                                    <p class="mb-2 text-xs font-weight-bold text-dark">Monto: ${{number_format($transaction->amount, 2, ',', '.')}}</p>
                                                        @foreach ($extras as $extra)
                                                            <span class="mb-2 text-xs font-weight-bold text-dark">{{$extra}}</span>
                                                        @endforeach
                                                </div>
                                                <div class="col-md-8 ms-auto text-end ps-6">
                                                    <form method="POST" action="/transaction/update" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="pb-3 text-end d-flex flex-column">
                                                            <label>Subir la imagen del recibo generado:</label>
                                                            <input style="border: gray 0.5px solid; border-radius: 20px" class="form-control form-control-sm" type="file" id="" name="voucher" required>
                                                        </div>
                                                        <div class="input-group input-group-static mb-4">
                                                            <label for="status"> La transacción fue:</label>
                                                              <select id="" name="status" class="form-control" aria-label="Default select example" required>
                                                                 <option value="successful">Exitosa</option>
                                                                 <option value="failed">Fallida</option>
                                                              </select>
                                                        </div>
                                                        <div class="input-group input-group-dynamic">
                                                            <textarea class="form-control" name="comment" rows="3" placeholder="Comentario:" spellcheck="false"></textarea>
                                                        </div>
                                                        <div class="pt-4 pb-1 text-center">
                                                            <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
                                                            <input class="btn btn-success" onclick="return confirm('¿está seguro de realizar la transacción?')"  type="submit" value="Enviar">
                                                        </div>
                                                    </form>
                                                @endif
                                                @if (Auth::user()->role == 'Shopkeeper' || Auth::user()->role =='Administrator' || Auth::user()->role =='Supplier' && ! is_null($detailSupplier))
                                                        <div class="col-md-6 d-flex flex-column ">
                                                            <h6 class="mb-3 text-sm">Datos de transacción</h6>
                                                            <p class="mb-2 text-xs font-weight-bold text-dark">Estado: <a class="mb-2 text-xl " style="color: darkred;">{{$transaction->status == 'successful' ? 'Exitosa' : 'Fallida' }}</a> </p>
                                                            <p class="mb-2 text-xs font-weight-bold text-dark">Producto: <a class="mb-2 text-xl " style="color: darkred;">{{$transaction->product->product_name}}</a> </p>
                                                            <p class="mb-2 text-xs font-weight-bold text-dark">Número de cuenta: <a class="mb-2 text-xl " style="color: darkred;">{{$transaction->account_number}}</a></p>
                                                            <p class="mb-2 text-xs font-weight-bold text-dark">
                                                                @if ($transaction->type == 'Withdrawal')
                                                                    Tipo de transacción: Retiro
                                                                @endif
                                                                @if ($transaction->type == 'Deposit')
                                                                    Tipo de transacción: Depósito
                                                                @endif
                                                            </p>
                                                            <p class="mb-2 text-xs font-weight-bold text-dark">Monto: ${{number_format($transaction->amount, 2, ',', '.')}}</p>
                                                            @foreach ($extras as $extra)
                                                                <p class="mb-2 text-xs font-weight-bold text-dark">{{$extra}}</p>
                                                        @endforeach
                                                            <p class="mb-2 text-xs font-weight-bold text-dark">Comentario: {{$transaction->comment}}</p>

                                                        </div>
                                                        <div class="col-md-6 d-flex flex-column">
                                                            <div>
                                                            <a class="btn btn-success text-center text-xs" href="/transaction/detail-pdf/{{$transaction->id}}"><i class="material-icons me-2">print</i>Imprimir comprobante</a>
                                                            </div>
                                                            <div class="input-group input-group-static mb-2 mt-2">
                                                                <a class="image-link" href="https://corresponsales.asparecargas.net{{$transaction->voucher}}">
                                                                <img class="image-link" width="200px" height="200px" src="https://corresponsales.asparecargas.net{{$transaction->voucher}}">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div style="display: none;" class="col-md-6">
                                                            <div class="input-group input-group-dynamic">
                                                                <textarea class="form-control" name="comment" rows="3" placeholder="Comentario:" spellcheck="false">{{$transaction->comment}}</textarea>
                                                            </div>
                                                        </div>
                                                @endif
                                                </div>
                                              </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection

