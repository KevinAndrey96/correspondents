<h2>Comisiones para el
    @if ($user->role == 'Shopkeeper')
        tendero
    @endif
    @if ($user->role == 'Distributor')
        distribuidor
    @endif
    @if ($user->role == 'Supplier')
        proveedor
    @endif
    {{$user->name}}
</h2>
<form method="POST" action="/commissions/update">
    @csrf
<table style="border: 1px solid black">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Comisión</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($commissions as $commission)
            <tr>
                <td>{{$commission->product->product_name}}</td>
                <td>{{$commission->amount}}</td>
                <td>
                    <input type="number" id="amount{{$commission->id}}"
                           onclick="amountChange({{ $commission->id }})"
                           step="0.01" min="0.01">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    <input type="hidden" name="amounts" id="amounts">
    <input type="hidden" name="ids" id="ids">
    <input type="submit" value="Modificar">
</form>
<script type="text/javascript">
    var amounts = new Array();
    var ids = new Array();

    function amountChange(commissionID){
        var inputAmount = document.getElementById('amount'+commissionID);
        var inputAmounts = document.getElementById('amounts');
        var inputIDS = document.getElementById('ids');
        inputAmount.addEventListener('blur',function(){
            if (! ids.includes(commissionID))
            {
                ids.push(commissionID);
                index = ids.indexOf(commissionID);
                amounts[index] = inputAmount.value;
            } else {
                index = ids.indexOf(commissionID);
                amounts[index] = inputAmount.value;
            }
            inputAmounts.value = amounts;
            inputIDS.value = ids;
        });
    }
</script>
