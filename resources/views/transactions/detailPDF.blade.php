<html>
    <head>
    <title>Transacción #{{$transaction->id}}</title>
    </head>
    <body>
        <h6>Comprobante Transacción #{{$transaction->id}}</h2>
        <div >
            <p >Fecha: {{$transaction->date}}</p>
            <p >Producto: {{$transaction->product->product_name}} -
                @if($transaction->product->product_type == 'Deposit')
                    Deposito
                @endif
                @if($transaction->product->product_type == 'Withdrawal')
                    Retiro
                @endif
            </p>
            <p >Número de cuenta: {{$transaction->account_number}}</p>
            <p >Monto solicitado: ${{$transaction->amount}}</p>
                @foreach ($extras as $extra)
                <p<span >{{$extra}}</span></p>
                @endforeach
            <p >Tendero: {{$transaction->Shopkeeper->name}}</p>
        </div>
    </body>
</html>