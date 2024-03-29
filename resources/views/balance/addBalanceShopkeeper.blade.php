@extends('layouts.dashboard')
@section('content')
    @if(Session::has('requestAlreadyExists'))
        <div class="alert alert-danger text-white text-center" role="alert">
            {{ Session::get('requestAlreadyExists') }}
        </div>
    @endif
    @if(Session::has('failedBalanceSaved'))
        <div class="alert alert-danger text-white text-center" role="alert">
            {{ Session::get('failedBalanceSaved') }}
        </div>
    @endif
    @if(Session::has('lowAmount'))
        <div class="alert alert-danger text-white text-center" role="alert">
            {{ Session::get('lowAmount') }}
        </div>
    @endif
    @if(Session::has('exceededAmountByCountry'))
        <div class="alert alert-danger text-white text-center" role="alert">
            {{ Session::get('exceededAmountByCountry') }}
        </div>
    @endif
    @if(Session::has('noAmount'))
        <div class="alert alert-danger text-white text-center" role="alert">
            {{ Session::get('noAmount') }}
        </div>
    @endif
    @if(Session::has('wrongBalance'))
        <div class="alert alert-danger text-white text-center" role="alert">
            {{ Session::get('wrongBalance') }}
        </div>
    @endif
    <div class="row"></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        @if (Auth::user()->brand_id)
                            <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Recargar saldo</h6>
                            </div>
                        @else
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Recargar saldo</h6>
                            </div>
                        @endif
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form action="/balance/store" id="form" method="post" enctype="multipart/form-data">
                              <div class="row">
                                @csrf
                                @if(count($errors)>0)
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                        @foreach( $errors->all() as $error )
                                                <li class="text-white"> <p class="text-center text-sm text-white">{{ $error }} </p></li>
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="amount" class="form-label">Monto</label>
                                        <input type="text" class="form-control" name="amount" value="" id="amount"
                                               placeholder="Monto" oninput="formatNumber('amount')" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="input-group  my-3">
                                      <label for="image" id="image_label" class="mx-3 my-1">Recibo</label>
                                      @if(isset($balance->boucher))
                                          <img class="img-thumbnail img-fluid" src="{{ 'https://corresponsales.asparecargas.net/'.$balance->boucher }}" width="100" alt = "No carga">
                                      @endif
                                      <input style="border: gray 0.5px solid; border-radius: 20px" class="form-control form-control-sm" type="file" id="image" name="image" required>
                                     </div>
                                </div>
                                  <div class="col-md-6">
                                      <div class="input-group input-group-outline my-3">
                                          <label for="payment_code" class="form-label"></label>
                                          <input type="text" class="form-control" name="payment_code" value="" id="payment_code" placeholder="Código de pago o número de transacción" required>
                                      </div>
                                  </div>
                                  <div class="col-md-6 mb-4">
                                      <div class="form-group my-3">
                                          <select class="form-select" name="card_id" id="card_id" onchange="showCard()" required>
                                              <option selected disabled>Seleccione un banco</option>
                                              @foreach ($cards as $card)
                                                  @if ($card->is_deleted != 1)
                                                      <option value="{{$card->id}}">{{strtoupper($card->bank)}}</option>
                                                  @endif
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <input type="hidden" id="minAmount" name="minAmount">
                                  <input type="hidden" id="penalty" name="penalty">
                                  <input type="hidden" id="finalBalance" name="finalBalance">

                                  <div class="text-center">
                                      @if (Auth::user()->brand_id)
                                          <input style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="btn btn-primary" type="submit" value="Enviar solicitud">
                                      @else
                                          <input class="btn btn-primary" type="submit" value="Enviar solicitud">
                                      @endif
                                      <a style="background-color: gray" class="btn text-white" href="{{ url('/home') }}"> Regresar</a>
                                  </div>
                              </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @foreach ($cards as $card)
    <div id="card{{$card->id}}" style="display: none;" class="container-fluid py-4 bank-card">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="{{$urlServer.$card->cardIMG}}" width="80%" height="auto" class="border-radius-lg">
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="{{$urlServer.$card->qr_img}}" width="60%" height="auto" class="border-radius-lg">
                            </div>
                            <div class="col-md-12">
                                <a href="{{$urlServer.$card->cardPDF}}" target="_blank" class="btn btn-primary
                                   btn-lg text-white active my-7 text-center" role="button" aria-pressed="true"><i class="material-icons mx-2">file_download</i>Descargar PDF</a>
                            </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
    @endforeach
    <div style="display: none;" class="container-fluid py-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="/assets/img/tarjeta2.jpeg" width="80%" height="auto" class="border-radius-lg">
                </div>
                <div class="col-md-6 text-center ">
                    <a href="/assets/pdf/TARJETA2.pdf" target="_blank" class="btn btn-primary
                 btn-lg text-white active my-7 text-center" role="button" aria-pressed="true"><i class="material-icons mx-2">file_download</i>Descargar PDF</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-->
        <div class="modal fade" id="penaltyAlert" tabindex="-1" role="dialog" aria-labelledby="SaldoModal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 d-flex">
                                <img width="70%" class="img-responsive ms-5" src="{{$urlServer}}/assets/img/danger_icon.png">
                            </div>
                            <div class="col-md-8">
                                <p style="font-size:20px; font-family:monospace;" id="alertText" class="text-primary"></p>
                            </div>
                            <div class="col-md-12 col-sm-12 mt-3 d-flex justify-content-center">
                                @if (Auth::user()->brand_id)
                                    <button style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="btn mx-1 text-white" id="acceptButton" data-bs-dismiss="modal">Aceptar</button>
                                @else
                                    <button class="btn btn-success bg-gradient mx-1" id="acceptButton" data-bs-dismiss="modal">Aceptar</button>
                                @endif
                                <button class="btn btn-secondary mx-2" data-bs-dismiss="modal">Rechazar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--end Modal-->


    <script type="text/javascript">
        function showCard()
        {
            bank = document.getElementById('card_id');
            card = document.getElementById('card'+bank.value);
            cards = document.querySelectorAll(".bank-card");

            cards.forEach(function(card){
                card.style.display = 'none';
            });
            console.log(cards);

            card.style.display = 'block';

            @foreach ($cards as $card)
                var cardID = parseInt({{$card->id}});

                if (cardID == parseInt($('#card_id').val())) {
                    $('#minAmount').val({{$card->min_amount}});
                    $('#penalty').val({{$card->penalty}});
                    $('#finalBalance').val(parseFloat($('#amount').val().toString().replace(',','')) - parseFloat('{{$card->penalty}}'));
                }
            @endforeach
            //console.log('minamount: ' + $('#minAmount').val()+', penalty: '+ $('#penalty').val() + ', finalbalance: '+ $('#finalBalance').val().toString());
        }
    </script>

    <script type="text/javascript">
        let modalShown = false;

        $(document).ready(function(){
            $('#form').on('submit', function(e){
                if (! modalShown) {
                    let amount = parseFloat($('#amount').val().toString().replace(',', ''));


                    @foreach ($cards as $card)
                    var cardID = parseInt({{$card->id}});

                    if (cardID == parseInt($('#card_id').val())) {
                        var minAmount = parseFloat({{$card->min_amount}});
                        var penalty = parseFloat({{$card->penalty}});
                    }
                    @endforeach
                    console.log(amount);
                    if (!isNaN(minAmount) && !isNaN(penalty) && amount < minAmount) {
                        e.preventDefault();
                        $('#penaltyAlert').modal('show');
                        modalShown = true;
                    }

                    $('#penaltyAlert').on('shown.bs.modal', function (e) {
                        console.log('ok');
                        $('#alertText').text('Está ingresando un monto para recarga de saldo con un valor menor que el monto ' +
                            'mínimo aceptado ($' + $('#minAmount').val().toString() + ') por el banco seleccionado, si continúa con ' +
                            'este proceso se aplicará una penalización al monto de saldo descontándole $' + $('#penalty').val().toString() +
                            ', el monto final de recarga saldo será de: $' + $('#finalBalance').val().toString() + '.')
                    });
                }
            });

            $('#acceptButton').click(function(e){
                $('#form').submit();
            });

            $("#amount").on("keyup", function() {
                modalShown = false;
            } );

        });
    </script>
@endsection
