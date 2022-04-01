<div class="container">
    
    @if(Session::has('mensaje'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
        </div>
    @endif
        
    <br/>
    <table id= "my_table" class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Usuario</th>
                <th>Saldo Actual</th>
                <th>Fecha Actual</th>
                <th>Ultimo Saldo</th>
                <th>Ultima fecha</th>
            </tr>
        </thead>

        <tbody>
            @foreach( $balances as $balance )
            <tr>
                <td>{{ $balance->user_id}}</td>
                <td>{{ $balance->balance_amount}}</td>
                <td>{{ $balance->balance_date}}</td>
                <td>{{ $balance->last_balance_amount}}</td>
                <td>{{ $balance->last_balance_date}}</td>
                <td>
                    <a href="{{ url('/balance/'.$balance->id.'/edit') }}" class="btn btn-warning"> Editar saldo</a>
                    
                    <form action="{{ url('/balance/'.$balance->id ) }}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger"onclick="return confirm('¿Quieres borrar?')"> Borrar saldo</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>