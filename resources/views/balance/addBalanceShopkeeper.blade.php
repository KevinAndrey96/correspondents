<div class="container">
    <form action="{{ url('/balance/store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h1>Solicitar saldo </h1>

        @if(count($errors)>0)
            <div class="alert alert-danger" role="alert">
                <ul>
                @foreach( $errors->all() as $error )
                    <li> {{ $error }} </li>
                @endforeach
                </ul>
            </div>    
        @endif

        <h1>Imagen de lista de bancos disponibles</h1>

        <div class="form-group">
            <label for="amount"> Monto </label>
            <input type="number" class="form-control" name="amount" value="" id="amount" step="10000" min="20000.0" placeholder="Monto">
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
        <a class="btn btn-primary" href="{{ url('/home') }}">Recargar saldo</a>
        <br>
        <input class="btn btn-success" type="submit" value="Enviar solicitud">

        <a class="btn btn-primary" href="{{ url('/home') }}"> Regresar</a>
    </form>
</div>