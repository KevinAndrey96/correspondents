<table id="my_table" >
    <thead>
        <tr>
            @if (Auth::user()->role == 'Administrator')
            <th>Usuario</th>
            <th>Rol</th>
            <th>Saldo Acumulado</th>
            @endif
            <th>N° de Solicitud</th>
            <th>Monto a retirar</th>
            <th>Fecha y hora</th>
            <th>Información</th>
            <th>¿Aceptada?</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($profits as $profit)
        <tr>
            @if (Auth::user()->role == 'Administrator')
            <td>{{ $profit->user->name}}</td>
            <td>
                @if($profit->user->role == 'Administrator')
                    Administrador
                @endif
                @if($profit->user->role == 'Distributor')
                    Distribuidor
                @endif
                @if($profit->user->role == 'Supplier')
                    Proveedor
                @endif
                @if($profit->user->role == 'Shopkeeper')
                    Tendero
                @endif
            </td>
            <td>${{number_format($profit->user->profit, 2, ',', '.')}}</td>
            @endif
            <td>{{ $profit->id}}</td>
            <td>${{number_format($profit->amount, 2, ',', '.')}}</td>
            <td>{{ $profit->created_at}}</td>
            <td>{{ $profit->extra}}</td>
            @if($profit->is_valid == 0)
            <td>No</td>
            @else
            <td>Si</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
