Duvan esto es un modal

<div class="container">
    <form action="{{ url('/balance') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1> Recargar saldo </h1>

        @if(count($errors)>0)
            <div class="alert alert-danger" role="alert">
                <ul>
                @foreach( $errors->all() as $error )
                    <li> {{ $error }} </li>
                @endforeach
                </ul>
            </div>    
        @endif
        <div class="form-group">
            <input type="hidden" class="form-control" name="userID" value="{{$user->id}}" id="productID" readonly="readonly">
        </div>

        <div class="input-group input-group-static mb-4">
            <label  for="">Tipo de transacción</label>
            <select id="type" name="type" class="form-control" aria-label="Default select example">
                <option class="text-center" value="">seleccionar</option>
                <option class="text-center" value="Deposit">Deposito</option>
                <option class="text-center" value="Withdrawal">Retiro</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="amount"> Monto </label>
            <input type="number" class="form-control" name="amount" value="" id="amount" step="100" min="20000.0" placeholder="Monto">
        </div>

        <div class="col-md-4">
            <div class="input-group input-group-static mb-4">
                <label for="image"> Recibo </label>
                @if(isset($balance->boucher))
                </br>
                <img class="img-thumbnail img-fluid" src="{{ 'https://corresponsales.asparecargas.net/'.$balance->boucher }}" width="100" alt = "No carga">
                </br>
                @endif
                <input type="file" class="form-control" name="image" value="" id="image">
            </div>
        </div>

        <br>
        <input class="btn btn-success" type="submit" value="Recargar saldo">

        <a class="btn btn-primary" href="{{ url('/balance/users') }}"> Regresar</a>
    </form>
</div>