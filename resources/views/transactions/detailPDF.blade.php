<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Transacción #{{$transaction->id}}</title>
    </head>
    <style>
        @page { margin: 10; }
    </style>
    <body >
    <img style="align-content: center;" src="https://corresponsales.asparecargas.net/assets/img/LOGO-COMPLETO.png" width="140px" height="50px">
        <h6 style="font-size: xx-small; text-align: center;">Comprobante Transacción #{{$transaction->id}}</h6>
        <h6 style="font-size: xx-small; text-align: center;">{{($transaction->status == 'successful') ? 'EXITOSA' : 'FALLIDA'}}</h6>
        <div style="margin-top:-20px;">
            <p style="font-size: xx-small; text-align: center;">Fecha: {{$transaction->created_at}}</p>
            <p style="font-size: xx-small; text-align: center; margin-top:-5px;">Producto: {{$transaction->product->product_name}} -
                @if($transaction->product->product_type == 'Deposit')
                    Deposito
                @endif
                @if($transaction->product->product_type == 'Withdrawal')
                    Retiro
                @endif
            </p>
            <p style="font-size: xx-small; text-align: center; margin-top:-5px;">Número de cuenta: {{$transaction->account_number}}</p>
            <p style="font-size: xx-small; text-align: center; margin-top:-5px;">Monto solicitado: ${{$transaction->amount}}</p>
                @foreach ($extras as $extra)
                <p style="font-size: xx-small; text-align: center; margin-top:-5px;"><span >{{$extra}}</span></p>
                @endforeach
            <h6 style="font-size: xx-small; text-align: center; margin-top:-5px;">Tendero: {{$transaction->Shopkeeper->name}}</h6>
            <h6 style="font-size: xx-small; text-align: center; margin-top:-5px;">www.asparecargas.net</h6>
        </div>
    </body>
</html>
