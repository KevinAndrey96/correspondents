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

        <div class="input-group input-group-static mb-4">
            <label  for="">Tipo de transacción</label>
            <select id="type" name="type" class="form-control" aria-label="Default select example" onchange = "hiddenText()">
                <option class="text-center" value="">seleccionar</option>
                <option class="text-center" value="Deposit">Deposito</option>
                <option class="text-center" value="Withdrawal">Retiro</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="amount"> Monto </label>
            <input type="number" class="form-control" name="amount" value="" id="amount" step="10000" min="20000.0" placeholder="Monto">
        </div>

        <div class="col-md-4">
            <div class="input-group input-group-static mb-4">
                <label for="image" id="image_label"> Recibo </label>
                @if(isset($balance->boucher))
                </br>
                <img class="img-thumbnail img-fluid" src="{{ 'https://corresponsales.asparecargas.net/'.$balance->boucher }}" width="100" alt = "No carga">
                </br>
                @endif
                <input type="file" class="form-control" name="image" value="" id="image">
            </div>
        </div>

        <div class="form-group">
            <label for="accountNumber" id="account_label"> Numero de cuenta </label>
            <input type="text" class="form-control" name="accountNumber" value="" id="accountNumber" placeholder="numero de cuenta">
        </div>

        <div class="form-group">
            <label for="entity" id="entity_label"> Entidad </label>
            <input type="text" class="form-control" name="entity" value="" id="entity" placeholder="Entidad">
        </div>

        <script>
            function hiddenText()
            {
                let image_label = document.getElementById("image_label");
                let account_label = document.getElementById("account_label");
                let entity_label = document.getElementById("entity_label");

                if(document.getElementById('type').value == "Withdrawal"){
                    document.getElementById("image").type = "hidden";
                    image_label.setAttribute("hidden", "hidden");
                    document.getElementById("accountNumber").type = "text";
                    account_label.removeAttribute("hidden");
                    document.getElementById("entity").type = "text";
                    entity_label.removeAttribute("hidden");
                }
                if(document.getElementById('type').value == "Deposit"){
                    document.getElementById("image").type = "file";
                    image_label.removeAttribute("hidden");
                    document.getElementById("accountNumber").type = "hidden";
                    account_label.setAttribute("hidden", "hidden");
                    document.getElementById("entity").type = "hidden";
                    entity_label.setAttribute("hidden", "hidden");
                }
                if(document.getElementById('type').value == ""){
                    document.getElementById("image").type = "hidden";
                    image_label.setAttribute("hidden", "hidden");
                    document.getElementById("accountNumber").type = "hidden";
                    account_label.setAttribute("hidden", "hidden");
                    document.getElementById("entity").type = "hidden";
                    entity_label.setAttribute("hidden", "hidden");
                }
            }
        </script>

        <br>
        <input class="btn btn-success" type="submit" value="Enviar solicitud">

        <a class="btn btn-primary" href="{{ url('/home') }}"> Regresar</a>
    </form>
</div>