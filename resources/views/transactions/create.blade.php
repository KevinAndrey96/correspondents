<div class="container">

    <form action="{{ url('/transaction/store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="hidden" class="form-control" name="shopkeeperID" value="{{$shopkeeperID}}" id="shopkeeperID" readonly="readonly">
        </div>

        <div>
            <label for="productID"> Producto </label>
            <select id="productID" name="productID" class="form-select" aria-label="Default select example">
                @foreach( $products as $product )
                    <option value="{{ $product->id }}" > {{ $product->product_name }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="transactionAmount" class="form-label"> Cantidad </label>
            <input type="number" class="form-control" name="transactionAmount" value="{{ isset($transaction->transaction_amount)?$transaction->transaction_amount:old('transaction_amount') }}" id="transactionAmount" step="1" min="0.0" placeholder="">
        </div>

        <div class="form-group">
            <label for="transactionDate"> Fecha </label>
            <input type="date" class="form-control" name="transactionDate" value="{{ isset($transaction->transactionDate)?$transaction->transactionDate:old('transactionDate') }}" id="transactionDate" placeholder="aa/mm/dd">
        </div>

        <div>
            <label for="transactionType"> Tipo de transaccion </label>
            <select id="transactionType" name="transactionType" class="form-select" aria-label="Default select example" onchange = "hiddenText()">
                <option value="deposito"  {{ old('transactionType') == 'deposito' ? 'selected' : '' }}>
                    Deposito
                </option>
                <option value="retiro" {{ old('transactionType') == 'retiro' ? 'selected' : '' }}>
                    Retiro
                </option>
            </select>
        </div>

        <div class="form-group">
            <input type="hidden" class="form-control" name="transactionState" value="en espera" id="transactionState" readonly="readonly">
        </div>

        <br>
        <input class="btn btn-success" type="submit" value="continuar">

        <a class="btn btn-primary" href="{{ url('/transactions') }}"> Regresar</a>
    </form>

</div>