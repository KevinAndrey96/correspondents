<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Transacción #{{$transaction->id}}</title>
        <!--Bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <style>
        @page { margin: 10; }
    </style>
    <body>
    @if (isset(Auth::user()->brand_id))
        <div class="d-flex text-center">
            <img src="{{$url.Auth::user()->brand->rectangular_logo_url}}" width="140px" height="50px">
        </div>
    @else
        <div class="d-flex text-center">
            <img src="{{$url}}/assets/img/LOGO-COMPLETO.png" width="140px" height="50px">
        </div>
    @endif
        <h6 style="font-size: xx-small; text-align: center;">Comprobante Transacción #{{$transaction->id}}</h6>
        <h6 style="font-size: xx-small; text-align: center;">{{($transaction->status == 'successful') ? 'EXITOSA' : 'FALLIDA'}}</h6>
        <div style="margin-top: 20px;">
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
            <p style="font-size: xx-small; text-align: center; margin-top:-5px;">Monto solicitado: ${{number_format($transaction->amount, 2, ',', '.')}}</p>
            <p style="font-size: xx-small; text-align: center; margin-top:-5px;">Comisión de tendero: ${{number_format($transaction->own_commission, 2, ',', '.')}}</p>
                @foreach ($extras as $extra)
                <p style="font-size: xx-small; text-align: center; margin-top:-5px;"><span >{{$extra}}</span></p>
                @endforeach
            <h6 style="font-size: xx-small; text-align: center; margin-top:-5px;">Tendero: {{$transaction->Shopkeeper->id}}</h6>
        </div>
    </body>
</html>
