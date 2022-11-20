<img src="/assets/img/footer.png" width="100%" height="auto" style="padding-bottom: 20px;">
<h6 style="color:darkblue; text-align: center;">¡Hola, {{ $emailBody->receiver }}!</h6>
<div>
    <p style="text-align: justify;">{{$emailBody->body}}</p>
    <ol>
    @foreach ($inactiveSuppliers as $supplier)
        <li>{{$supplier->name}}</li>
    @endforeach
    </ol>
</div>
<br/>
<br/>
<br/>
<small>Este correo fue enviado automáticamente, agradecemos no responder este mensaje.</small>
<br/>
<i>{{ $emailBody->sender }}</i>
<img src="/assets/img/footer1.png" width="100%" height="auto" style="padding-top: 20px;">
