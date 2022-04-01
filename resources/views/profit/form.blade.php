<h1>{{ $mode }} Ganancia </h1>

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach( $errors->all() as $error )
            <li> {{ $error }} </li>
        @endforeach
        </ul>
    </div>    

@endif

@if($mode=="Crear")
<div class="form-group">
    <input type="hidden" class="form-control" name="userID" value="{{$userID}}" id="userID" readonly="readonly">
</div>

<div class="form-group">
    <label for="profitAmount"> Ganancia inicial </label>
    <input type="number" class="form-control" name="profitAmount" value="{{ isset($profit->profit_amount)?$profit->profit_amount:old('profit_amount') }}" id="profitAmount" step="1" min="0.0" placeholder="Ganancia inicial">
</div>
@endif

@if($mode=="Editar")
<div class="form-group">
    <label for="profitAmount"> Cantidad a retirar </label>
    <input type="number" class="form-control" name="profitAmount" value="{{ isset($profit->profit_amount)?$profit->profit_amount:old('profit_amount') }}" id="profitAmount" step="1" min="0.0" placeholder="Retirar ganancia">
</div>
@endif

<br>
<input class="btn btn-success" type="submit" value="{{ $mode }} datos">

<a class="btn btn-primary" href="{{ url('/profit') }}"> Regresar</a>
