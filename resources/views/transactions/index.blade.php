<div class="container">
    
    @if(Session::has('mensaje'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
        </div>
    @endif

    <br/>
    <br/>
    <table id= "my_table" class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Tendero</th>
                <th>Distribuidor</th>
                <th>Proveedor</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Documento Cliente</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Tipo de Transaccion</th>
                <th>Estado de Transaccion</th>
                <th>Extras</th>
                <th>Recibo</th>
            </tr>
        </thead>

        <tbody>
            @foreach( $transactions as $transaction )
            <tr>
                <td>{{ $transaction->shopkeeper_id }}</td>
                <td>{{ $transaction->distributor_id }}</td>
                <td>{{ $transaction->supplier_id }}</td>
                <td>{{ $transaction->product_id }}</td>
                <td>{{ $transaction->client_name }}</td>
                <td>{{ $transaction->client_document }}</td>
                <td>{{ $transaction->transaction_amount }}</td>
                <td>{{ $transaction->transaction_date }}</td>
                <td>{{ $transaction->transaction_type }}</td>
                <td>{{ $transaction->transaction_state }}</td>
                <td>{{ $transaction->product_requirements }}</td>
                <td>
                @if(isset($transaction->transaction_receipt))
                <img class="img-thumbnail img-fluid" src="{{ 'http://127.0.0.1:8000/'.$transaction->transaction_receipt }}" width="100" alt = "No carga">
                @else
                No hay imagen
                @endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>  
</div>