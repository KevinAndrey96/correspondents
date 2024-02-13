<!DOCTYPE html>
<html lang="es">
<head>
    <title>Transacción #{{$balance->id}}</title>
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
<h6 style="font-size: xx-small; text-align: center;">Comprobante de Saldos #{{$balance->id}}</h6>
<div style="margin-top: 20px;">
    <p style="font-size: xx-small; text-align: center;">Fecha: {{$balance->updated_at}}</p>
    <p style="font-size: xx-small; text-align: center; margin-top:-5px;">Monto solicitado: ${{number_format($balance->amount, 2, ',', '.')}}</p>
    <p style="font-size: xx-small; text-align: center; margin-top:-5px;">Estado de la solicitud: {{($balance->is_valid == 1) ? 'ACEPTADA' : 'RECHAZADA' }}</p>
    <p style="font-size: xx-small; text-align: center; margin-top:-5px;">Usuario de la solicitud: {{$balanceOwner->name}}</p>
</div>
</body>
</html>
