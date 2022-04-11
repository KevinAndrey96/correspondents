<div class="container">

    <form action="{{ url('/transaction/storeClientData') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="hidden" class="form-control" name="shopkeeperID" value="{{$transaction->shopkeeper_id}}" id="shopkeeperID" readonly="readonly">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name="distributorID" value="{{$transaction->distributor_id}}" id="distributorID" readonly="readonly">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name="supplierID" value="{{$transaction->supplier_id}}" id="supplierID" readonly="readonly">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name="productID" value="{{$transaction->product_id}}" id="productID" readonly="readonly">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name="transactionAmount" value="{{$transaction->transaction_amount}}" id="transactionAmount" readonly="readonly">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name="transactionDate" value="{{$transaction->transaction_date}}" id="transactionDate" readonly="readonly">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name="transactionType" value="{{$transaction->transaction_type}}" id="transactionType" readonly="readonly">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" name="transactionState" value="{{$transaction->transaction_state}}" id="transactionState" readonly="readonly">
        </div>

        @if($product->client_name == 1)
        <div class="form-group">
            <label for="clientName" >nombre del cliente</label>
            <input type="text" class="form-control" name="clientName" id="clientName" placeholder="Nombre del cliente">
        </div>
        @endif
        @if($product->name_field == 1)
        <div class="form-group">
            <label for="nameField" >Documento del Cliente</label>
            <input type="text" class="form-control" name="nameField" id="nameField" placeholder="Documento del cliente">
        </div>
        @endif
        @if($product->email == 1)
        <div class="form-group">
            <label for="email" >Email</label>
            <input type="email" class="form-control" name="email" value="" id="" placeholder="Correo electrónico">
        </div>
        @endif
        @if($product->phone_number == 1)
        <div class="form-group">
            <label for="phoneNumber" >telefono del cliente</label>
            <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="telefono del cliente">
        </div>
        @endif
        @if($product->account_type == 1)
        <div class="form-group">
            <label for="accountType" >tipo de cuenta</label>
            <input type="text" class="form-control" name="accountType" id="accountType" placeholder="tipo de cuenta">
        </div>
        @endif
        @if($product->account_number == 1)
        <div class="form-group">
            <label for="accountNumber" >numero de cuenta</label>
            <input type="text" class="form-control" name="accountNumber" id="accountNumber" placeholder="Numero de cuenta">
        </div>
        @endif
        @if($product->code == 1)
        <div class="form-group">
            <label for="code" >Codigo</label>
            <input type="text" class="form-control" name="code" id="code" placeholder="codigo">
        </div>
        @endif
        @if($product->extra == 1)
        <div class="form-group">
            <label for="extra" >informacion extra</label>
            <input type="text" class="form-control" name="extra" id="extra" placeholder="informacion extra">
        </div>
        @endif
        <br>
        <input class="btn btn-success" type="submit" value="Solicitar Transaccion">
    </form>

</div>