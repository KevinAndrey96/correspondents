<img src="{{getenv('APP_URL')}}/assets/img/footer.png" width="100%" height="auto" style="padding-bottom: 20px;">
<h3 style="color:darkblue; text-align: center;">¡Hola, {{ $body->receiver }}!</h3>
<div>
    <p style="text-align: justify;">{{$body->body}}</p>
    @if (isset($body->userBrandDomain))
        <p style="text-align: justify;">Puede ingresar a su cuenta desde la página <a href="https://{{$body->userBrandDomain}}/login">{{$body->userBrandDomain}}</a></p>
    @else
        <p style="text-align: justify;">Puede ingresar a su cuenta desde la página <a href="{{getenv('APP_URL')}}">{{getenv('APP_URL')}}</a></p>
    @endif
</div>
<br/>
<br/>
<br/>
<small>Este correo fue enviado automáticamente, agradecemos no responder este mensaje.</small>
<br/>
<i>{{ $body->sender }}</i>
<img src="{{getenv('APP_URL')}}/assets/img/footer1.png" width="100%" height="auto" style="padding-top: 20px;">
