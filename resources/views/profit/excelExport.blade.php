<table id="my_table" >
    <thead>
        <tr>
            @hasrole('Administrator')
            <th>Usuario</th>
            <th>Saldo Acumulado</th>
            @endhasrole
            <th>N° de Solicitud</th>
            <th>Monto a retirar</th>
            <th>Fecha</th>
            <th>¿Validado?</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($profits as $profit)       
        <tr>
            @hasrole('Administrator')
            <td >{{ $profit->user->name}}</td>
            <td >{{ $profit->user->profit}}</td>
            @endhasrole
            <td>{{ $profit->id}}</td>
            <td>{{ $profit->amount}}</td>
            <td>{{ $profit->date}}</td>
            @if($profit->is_valid == 0)
            <td>No</td>
            @else
            <td>Si</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>