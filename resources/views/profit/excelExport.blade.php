<table id="my_table" >
    <thead>
        <tr>
            @hasrole('Administrator')
            <th>Usuario</th>
            <th>Rol</th>
            <th>Saldo Acumulado</th>
            @endhasrole
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
            @hasrole('Administrator')
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
            <td>{{ $profit->user->profit}}</td>
            @endhasrole
            <td>{{ $profit->id}}</td>
            <td>{{ $profit->amount}}</td>
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
