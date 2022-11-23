@extends('layouts.dashboard')
@section('content')
    <div class="row "></div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Recargar saldo</h6>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form action="{{ url('/balance/store') }}" method="post" enctype="multipart/form-data">
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
                                        <label for="amount" class="form-label"></label>
                                        <input type="number" class="form-control" name="amount" value="" id="amount" step="1" min="0" placeholder="Monto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="input-group  my-3">
                                      <label for="image" id="image_label" class="mx-3 my-1">Recibo</label>
                                      @if(isset($balance->boucher))
                                          <img class="img-thumbnail img-fluid" src="{{ 'https://corresponsales.asparecargas.net/'.$balance->boucher }}" width="100" alt = "No carga">
                                      @endif
                                      <input style="border: gray 0.5px solid; border-radius: 20px" class="form-control form-control-sm" type="file" id="image" name="image">
                                     </div>
                                </div>
                                  <div class="col-md-6 mb-4">
                                      <div class="form-group">
                                          <label for="bank" class="form-label">Banco:</label>
                                          <select class="form-select" name="bank" id="bank" onchange="showCard()">
                                              <option>Seleccione un banco</option>
                                              @foreach($cards as $card)
                                                <option value="{{$card->id}}">{{$card->bank}}</option>
                                              @endforeach

                                          </select>
                                      </div>
                                  </div>
                                  <div class="text-center">
                                      <input class="btn btn-primary" type="submit" value="Enviar solicitud">

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
                        <img src="https://testing.asparecargas.net{{$card->cardIMG}}" width="80%" height="auto" class="border-radius-lg">
                    </div>
                    <div class="col-md-6 text-center">
                        <a href="https://testing.asparecargas.net{{$card->cardPDF}}" target="_blank" class="btn btn-primary
                        btn-lg text-white active my-7 text-center" role="button" aria-pressed="true"><i class="material-icons mx-2">file_download</i>Descargar PDF</a>
                    </div>

                <!--
            <div class="col-md-6 text-center">
                <img src="/assets/img/tajeta.jpeg" width="80%" height="auto" class="border-radius-lg">
            </div>
            <div class="col-md-6 text-center ">
                <a href="/assets/pdf/TARJETA.pdf" target="_blank" class="btn btn-primary
                 btn-lg text-white active my-7 text-center" role="button" aria-pressed="true"><i class="material-icons mx-2">file_download</i>Descargar PDF</a>
            </div>
            -->

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

    <script type="text/javascript">

        function showCard()
        {
            bank = document.getElementById('bank');
            card = document.getElementById('card'+bank.value);
            cards = document.querySelectorAll(".bank-card");

            cards.forEach(function(card){
                card.style.display = 'none';
            });
            console.log(cards);

            card.style.display = 'block';


        }
    </script>
@endsection
