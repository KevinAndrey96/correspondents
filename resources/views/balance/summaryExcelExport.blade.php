<table id="my_table" >
    <thead>
        <tr>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Movimiento</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Usuario</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre Usuario</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Banco</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de movimiento</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comisión fija</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo Previo</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo Resultante</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha y hora</th>
        </tr>
    </thead>
    <tbody>
    @foreach( $summaries as $summary )
        <tr>
            <td class="align-middle text-center text-sm">{{ $summary->movement_id }}</td>
            <td class="align-middle text-center text-sm">{{ $summary->user_id }}</td>
            <td class="align-middle text-center text-sm">{{ $summary->user->name }}</td>
            <td class="align-middle text-center text-sm">
                @if (isset($summary->product_name))
                    {{ $summary->product_name }}
                @else
                    NO APLICA
                @endif

            </td>
            <td class="align-middle text-center text-sm">
                @if (isset($summary->bank))
                    {{$summary->bank}}
                @else
                    NO APLICA
                @endif

            </td>
            <td class="align-middle text-center text-sm">{{ $summary->movement_type }}</td>
            <td class="align-middle text-center text-sm">${{ number_format($summary->fixed_commission, 2, ',', '.') }}</td>
            <td class="align-middle text-center text-sm">${{ number_format($summary->amount, 2, ',', '.') }}</td>
            <td class="align-middle text-center text-sm">${{ number_format($summary->previous_balance, 2, ',', '.') }}</td>
            <td class="align-middle text-center text-sm">${{ number_format($summary->next_balance, 2, ',', '.') }}</td>
            <td class="align-middle text-center text-sm">{{ $summary->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
