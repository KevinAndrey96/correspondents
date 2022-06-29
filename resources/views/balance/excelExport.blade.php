<table id="my_table" >
    <thead>
        <tr>
        @hasrole('Administrator')
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo Actual</th>
        @endhasrole
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° de Solicitud  </th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de Solicitud</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto solicitado</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">¿Es valido?</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $balances as $balance )
        <tr>
            @hasrole('Administrator')
            <td class="align-middle text-center text-sm">{{ $balance->user->name}}</td>
            <td class="align-middle text-center text-sm">{{ $balance->user->balance}}</td>
            @endhasrole
            <td class="align-middle text-center text-sm">{{ $balance->id}}</td>
            @if($balance->type == 'Deposit')
            <td class="align-middle text-center text-sm">Deposito</td>
            @elseif($balance->type == 'Withdrawal')
            <td class="align-middle text-center text-sm">Retiro por Administrador</td>
            @endif
            <td class="align-middle text-center text-sm">{{ $balance->amount}}</td>
            <td class="align-middle text-center text-sm">{{ $balance->date}}</td>
            @if($balance->is_valid == 0)
            <td class="align-middle text-center text-sm">No</td>
            @else
            <td class="align-middle text-center text-sm">Si</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
