<table id="my_table" >
    <thead>
        <tr>
            <th>id</th>
            <th>tendero</th>
            <th>Proveedor</th>
            <th>Producto</th>
            <th>Monto</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Detalle</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{$transaction->id}}</td>
            <td>{{$transaction->shopkeeper->name}}</td>
            <td>
                @if (!$transaction->supplier_id)
                    NA
                @else
                    {{$transaction->supplier->name}}
                @endif
            </td>
            <td>{{$transaction->product->product_name}} -
                @if($transaction->product->product_type == 'Deposit')
                    Deposito
                @endif
                @if($transaction->product->product_type == 'Withdrawal')
                    Retiro
                @endif
            </td>
            <td>${{$transaction->amount}}</td>
            <td>{{$transaction->status}}</td>
            <td>{{$transaction->created_at}}</td>
            <td>{{$transaction->detail}}</td>

        </tr>
        @endforeach
    </tbody>
</table>
