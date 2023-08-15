@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        @if (isset(Auth::user()->brand_id))
                            <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg  pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3"></a>Detalles de transacción</h6>
                            </div>
                        @else
                            <div class="bg-gradient-primary shadow-primary border-radius-lg  pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3"></a>Detalles de transacción</h6>
                            </div>
                        @endif
                    </div>
                    <div class="card-body px-0 pb-4">
                        <div class="row">
                            <div class="col-md-2 mt-1"></div>
                            <div class="col-md-7 mt-1">
                                @if (isset(Auth::user()->brand_id))
                                    <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="card bg-primary">
                                    @else
                                            <div class="card bg-primary">
                                    @endif
                                    <div style="position:relative;" class="card-body pt-2 p-2">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 d-flex p-4 mb-0 bg-gray-100 border-radius-lg">
                                              <div class="row">
                                                  @if (Auth::user()->brand_id)
                                                    <a href="#" class="btn btn-info p-0" id="chatIcon" style="position:absolute; left:88%; top:3%; width:12%; background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" title="Comunicarse con tendero" onclick="openSecondaryWindow()">Chat<i style="color: white; font-size: 30px !important;" class="material-icons opacity-10">forum</i></a>
                                                  @else
                                                      <a href="#" class="btn btn-info p-0" id="chatIcon" style="position:absolute; left:88%; top:3%; width:12%;" title="Comunicarse con tendero" onclick="openSecondaryWindow()">Chat<i style="color: white; font-size: 30px !important;" class="material-icons opacity-10">forum</i></a>
                                                  @endif
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
                                                    <form method="POST" action="/transaction/update" id="updateForm" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="pb-3 text-end d-flex flex-column">
                                                            <label>Subir la imagen del recibo generado:</label>
                                                            <input style="border: gray 0.5px solid; border-radius: 20px" class="form-control form-control-sm" type="file" id="" name="voucher" required>
                                                        </div>
                                                        <div class="input-group input-group-static mb-4">
                                                            <label for="status"> La transacción fue:</label>
                                                              <select id="status-select" name="status" class="form-control" aria-label="Default select example" onchange="confirmSelection(this)" required>
                                                                  <option selected disabled>Seleccione una opción</option>
                                                                  <option value="successful">Exitosa</option>
                                                                  <option value="failed">Fallida</option>
                                                              </select>
                                                        </div>
                                                        <div style="display:none;"  class="input-group input-group-static mb-4" id="observation-select-div" >
                                                            <label for="observation">Seleccione una observación:</label>
                                                            <select  id="observation-select" name="observation" class="form-control" aria-label="Default select example" required>
                                                                <option value="Ninguna" selected>Ninguna</option>
                                                                @foreach($answers as $answer)
                                                                    <option value="{{$answer->answer}}">{{$answer->answer}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="input-group input-group-dynamic">
                                                            <textarea class="form-control" name="comment" rows="3" placeholder="Comentario:" spellcheck="false"></textarea>
                                                        </div>
                                                        <div class="pt-4 pb-1 text-center d-flex justify-content-center">
                                                            <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
                                                            <a href="{{route('transactions.transfer', ['id' => $transaction->id])}}" class="btn btn-primary me-2" onclick="return confirm('¿Está seguro que quiere trasladar la transacción a otro proveedor?')">Trasladar</a>
                                                            <input class="btn btn-success" id="submitButton" onclick="hideButton()" type="submit" value="Enviar">
                                                        </div>
                                                    </form>
                                                @endif
                                                @if (Auth::user()->role == 'Shopkeeper' || Auth::user()->role =='Administrator' || Auth::user()->role =='Supplier' && ! is_null($detailSupplier))
                                                        <div class="col-md-4 d-flex flex-column ">
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
                                                            <p class="mb-2 text-xs font-weight-bold text-dark">Comisión de tendero: ${{number_format($transaction->own_commission, 2, ',', '.')}}</p>
                                                        @foreach ($extras as $extra)
                                                                <p class="mb-2 text-xs font-weight-bold text-dark">{{$extra}}</p>
                                                            @endforeach
                                                            <p class="mb-2 text-xs font-weight-bold text-dark">Comentario: {{$transaction->comment}}</p>
                                                            <p class="mb-2 text-xs font-weight-bold text-dark">Observación: {{$transaction->observation}}</p>

                                                        </div>
                                                        <div class="col-md-8 d-flex flex-column ms-auto me-auto pe-2">
                                                            <div class="me-auto">
                                                            <a class="btn btn-success text-center text-xs" href="/transaction/detail-pdf/{{$transaction->id}}"><i class="material-icons me-2">print</i>Imprimir comprobante</a>
                                                            </div>
                                                            <div class="input-group input-group-static mb-2 mt-2">
                                                                @if (Auth::user()->role == 'Shopkeeper')
                                                                    @if ($transaction->status == 'successful')
                                                                        <p style="font-size:200%" class="text-success text-opacity-75 text-center font-weight-bold">
                                                                            Transacción Exitosa
                                                                        </p>
                                                                    @else
                                                                        <p style="font-size:200%" class="text-danger text-opacity-75 text-center font-weight-bold">
                                                                            Transacción Fallida
                                                                        </p>
                                                                    @endif
                                                                @endif
                                                                <a class="image-link" href="{{$urlServer}}{{$transaction->voucher}}">
                                                                    @if (! is_null($transaction->voucher) && ($transaction->status == 'successful' || $transaction->status == 'failed' ) && Auth::user()->role !== 'Shopkeeper')
                                                                        <img class="image-link rounded" width="200px" height="200px" src="{{$urlServer}}{{$transaction->voucher}}">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div style="display: none;" class="col-md-6">
                                                            <div class="input-group input-group-dynamic">
                                                                <textarea class="form-control" name="comment" rows="3" placeholder="Comentario:" spellcheck="false">{{$transaction->comment}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row justify-content-center">
                                                                <div class="col-md-8 ms-auto me-auto mt-4">
                                                                    <form id="form-wp" target="_blank" method="get" action="https://api.whatsapp.com/send">
                                                                    <!--<a  href="{{route('number.whatsapp')}}?transactionID={{$transaction->id}}&voucher={{$transaction->voucher}}" class="link-primary">Enviar comprobante a Whatsapp</a>-->

                                                                        <div class="row">
                                                                            <div class="col-xs-12 col-sm-12 col-md-9 mb-3">
                                                                                <img width="10%" src="{{$urlServer}}/assets/img/whatsapp.png" alt="">
                                                                                <span class="text-xs font-weight-bold text-dark">Enviar comprobante: </span>
                                                                                    <div class="input-group mx-2 d-inline">
                                                                            <input style="background:white; width:100%;" type="text" name="phone" id="phone" class="form-control text-center d-inline border-top border-start border-bottom p-2">
                                                                                        <input type="hidden" name="text" value="'Hola, este es el comprobante de la transacción: {{$urlServer}}/transaction/detail-pdf/{{$transaction->id}}">
                                                                                    </div>
                                                                            </div>
                                                                        <div style="width:20%" class="col-xs-12 col-sm-12 col-md-3 p-0 ms-3 mt-4">
                                                                            <input type="submit" class="btn btn-success bg-gradient " value="Enviar" onclick="sendWP({{$callSign}})">
                                                                        </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        </div>
                                                <script>
                                                    function hideButton()
                                                    {
                                                        var subButton = document.getElementById('submitButton');
                                                        var form = document.getElementById('updateForm');
                                                        form.submit();
                                                        subButton.disabled = true;
                                                    }
                                                    function sendWP(id)
                                                    {
                                                        var numPhone = document.getElementById('phone');
                                                        var form = document.getElementById('form-wp');
                                                        numPhone.value = id+numPhone.value;
                                                        form.send();
                                                    }
                                                </script>
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
    <script type="text/javascript">
        function confirmSelection(select)
        {
            var isConfirmed = confirm('¿Está seguro de esta elección?');
            var observationSelectDiv = document.getElementById('observation-select-div')
            var observationSelect = document.getElementById('observation-select')
            if (! isConfirmed) {
                select.value = null;
            }

            if (select.value == 'failed') {
                observationSelectDiv.style.display = 'block';
                observationSelect.disabled = false;
            } else {
                observationSelectDiv.style.display = 'none';
                observationSelect.disabled = true;
            }

        }
    </script>
    <script type="text/javascript">
        function openSecondaryWindow()
        {
            var secondaryWindow;
            var iframe;

            secondaryWindow = window.open('', 'secondaryWindow', 'width=400,height=500');
            iframe = '<iframe src="{{$urlServer.'/chat/'.$transaction->id}}" width="100%" height="100%">';
            secondaryWindow.document.write(iframe)
        }
    </script>

@endsection

