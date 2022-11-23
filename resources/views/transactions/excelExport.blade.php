<table id="my_table" >
    <thead>
        <tr>
            <th>id</th>
            <th>Distribuidor</th>
            <th>Tendero</th>
            <th>Proveedor</th>
            <th>IP Tendero</th>
            <th>Producto</th>
            <th>Monto</th>
            <th>Estado</th>
            <th>Fecha y hora</th>
            <th>Cuenta</th>
            <th>Detalle</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{$transaction->id}}</td>
            <td>{{$transaction->distributor->name}}</td>
            <td>{{$transaction->shopkeeper->name}}</td>
            <td>
                @if (!$transaction->supplier_id)
                    NA
                @else
                    {{$transaction->supplier->name}}
                @endif
            </td>
            <td>{{$transaction->userIP}}</td>
            <td>{{$transaction->product->product_name}} -
                @if($transaction->product->product_type == 'Deposit')
                    Deposito
                @endif
                @if($transaction->product->product_type == 'Withdrawal')
                    Retiro
                @endif
            </td>
            <td>${{number_format($transaction->amount, 2, ',', '.')}}</td>
            <td>
                @if($transaction->status == 'successful')
                    Exitoso
                @endif
                @if($transaction->status == 'failed')
                    Fallido
                @endif
                @if($transaction->status == 'cancelled')
                    Cancelado
                @endif
                @if($transaction->status == 'hold')
                    En Espera
                @endif
            </td>
            <td>{{$transaction->created_at}}</td>
            <td>{{$transaction->account_number}}</td>
            <td>{{$transaction->detail}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
