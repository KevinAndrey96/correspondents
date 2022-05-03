@if (Auth::user()->role == 'Supplier')
<h3>Información extra</h3>
@foreach ($extras as $extra)
<p>{{$extra}}</p>
@endforeach
<form method="POST" action="/transaction/update" enctype="multipart/form-data">
    @csrf
    <label>Por favor suba una imagen con el recibo generado:</label>
    <br/>
    <input type="file" name="voucher" required>
    <br/>
    <br/>
    <label>La transacción fue:</label>
    <br/>
    <select name="status" required>
        <option value="successful">Exitosa</option>
        <option value="failed">Fallida</option>
    </select>
    <br/>
    <br/>
    <label>Comentario:</label>
    <br>
    <textarea name="comment"></textarea>
    <br/>
    <br/>
    <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
    <input  type="submit" value="Enviar">
</form>
@endif
@if (Auth::user()->role == 'Shopkeeper')
    <label>Recibo:</label>
    <br/>
    <img width="300px" src="https://corresponsales.asparecargas.net{{$transaction->voucher}}">
    <br/>
    <br/>
    <label>Comentario:</label>
    <p>{{$transaction->comment}}</p>
@endif
