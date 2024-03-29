<table id="my_table" >
    <thead>
        <tr>
        @if (Auth::user()->role == 'Administrator')
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo Actual</th>
        @endif
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° de Solicitud  </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banco</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de Solicitud</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto solicitado</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha y hora</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">¿Es valido?</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre administrador</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rol administrador</th>

        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comentario</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $balances as $balance )
        <tr>
            @if (Auth::user()->role == 'Administrator')
            <td class="align-middle text-center text-sm">{{ $balance->user->name}}</td>
            <td class="align-middle text-center text-sm">${{number_format($balance->user->balance, 2, ',', '.')}}</td>
            @endif
            <td class="align-middle text-center text-sm">{{$balance->id}}</td>
            <td class="align-middle text-center text-sm">
                @if (isset($balance->product_name))
                    {{strtoupper($balance->product_name)}}
                    @else
                    NO APLICA
                @endif
            </td>
            <td class="align-middle text-center text-sm">
                @if (isset($balance->card->bank))
                    {{strtoupper($balance->card->bank)}}
                @else
                    NO APLICA
                @endif
            </td>
            @if ($balance->type == 'Deposit')
            <!--<td class="align-middle text-center text-sm">Deposito</td>-->
                <td class="align-middle text-center text-sm">Retiro Realizado</td>
            @elseif ($balance->type == 'Withdrawal')
            <!--<td class="align-middle text-center text-sm">Retiro por Administrador</td>-->
                <td class="align-middle text-center text-sm">Deposito Realizado</td>
            @elseif ($balance->type == 'Recharge')
                    <td class="align-middle text-center text-sm">Recarga de Saldo</td>
                @endif
            <td class="align-middle text-center text-sm">${{number_format($balance->amount, 2, ',', '.')}}</td>
            <td class="align-middle text-center text-sm">{{ $balance->created_at}}</td>
            @if($balance->is_valid == 0)
                <td class="align-middle text-center text-sm">No</td>
            @else
                <td class="align-middle text-center text-sm">Si</td>
            @endif
            <td class="align-middle text-center text-sm">
                @if(isset($balance->administrator->name))
                    {{$balance->administrator->name}}
                @endif
            </td>
            <td class="align-middle text-center text-sm">
                @if(isset($balance->administrator->role))
                    @if ($balance->administrator->role == 'Administrator')
                        Administrador
                    @else
                        Saldos
                    @endif
                @endif
            </td>
            <td class="align-middle text-center text-sm">{{$balance->comment}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
