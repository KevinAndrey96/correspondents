<div style="height:100%; display:flex; justify-content:center; align-items: center;" >
    <div style="background:red; width:30%">
        <p><strong>Número de cuenta:</strong> {{$transaction->account_number}}</p>
        <p><strong>Monto:</strong> {{$transaction->amount}}</p>
        <p><strong>Tipo:</strong>
            @if ($transaction->type == 'Deposit')
            Deposito
            @endif
            @if ($transaction->type == 'Withdrawal')
            Retiro
            @endif
        </p>
        <p><strong>Producto:</strong> {{$transaction->product->product_name}}</p>

    </div>
</div>
