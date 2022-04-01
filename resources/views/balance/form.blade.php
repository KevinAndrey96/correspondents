<h1>{{ $mode }} saldo </h1>

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
@endif

<div class="form-group">
    <label for="balanceAmount"> Saldo </label>
    <input type="number" class="form-control" name="balanceAmount" value="{{ isset($balance->balance_amount)?$balance->balance_amount:old('balance_amount') }}" id="balanceAmount" step="1" min="0.0" placeholder="Saldo">
</div>

<br>
<input class="btn btn-success" type="submit" value="{{ $mode }} datos">

<a class="btn btn-primary" href="{{ url('/balance') }}"> Regresar</a>
