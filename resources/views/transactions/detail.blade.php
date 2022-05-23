@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
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
                                                @if (Auth::user()->role == 'Supplier')
                                                <div class="col-md-4 d-flex flex-column ">
                                                    <h6 class="mb-3 text-sm">Información</h6>
                                                    <p class="mb-2 text-xs font-weight-bold text-dark">Producto: {{$transaction->product->product_name}}</p>
                                                    <p class="mb-2 text-xs font-weight-bold text-dark">Número de cuenta: {{$transaction->account_number}}</p>
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
                                                @if (Auth::user()->role == 'Shopkeeper')
                                                     <div class="input-group input-group-static mb-4">
                                                         <label>Recibo:</label>
                                                         <img width="300px" src="https://corresponsales.asparecargas.net{{$transaction->voucher}}">
                                                     </div>
                                                     <div class="input-group input-group-dynamic">
                                                          <textarea class="form-control" name="comment" rows="3" placeholder="Comentario:" spellcheck="false">{{$transaction->comment}}</textarea>
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
    </div>
@endsection

