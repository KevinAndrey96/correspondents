<img src="https://testing.asparecargas.net/assets/img/footer.png" width="100%" height="auto" style="padding-bottom: 20px;">
<h2 style="color:darkblue; text-align: center;">¡Hola, {{ $emailBody->receiver }}!</h2>
<div>
    <p style="text-align: justify;">{{$emailBody->body}}</p>
    <ol>
    @foreach ($inactiveSuppliers as $supplier)
        <li><p style="font-size:20px">{{$supplier->name}}</p></li>
    @endforeach
    </ol>
</div>
<br/>
<br/>
<br/>
<small>Este correo fue enviado automáticamente, agradecemos no responder este mensaje.</small>
<br/>
<i>{{ $emailBody->sender }}</i>
<img src="https://testing.asparecargas.net/assets/img/footer1.png" width="100%" height="auto" style="padding-top: 20px;">
