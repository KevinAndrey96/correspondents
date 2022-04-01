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
                <th>Ganancia Acumulada</th>
                <th>Ultimo retiro</th>
                <th>Penultimo retiro</th>
            </tr>
        </thead>

        <tbody>
            @foreach( $profits as $profit )
            <tr>
                <td>{{ $profit->user_id}}</td>
                <td>{{ $profit->profit_amount}}</td>
                <td>{{ $profit->withdrawal_date}}</td>
                <td>{{ $profit->last_withdrawal_date}}</td>
                <td>
                    <a href="{{ url('/profit/'.$profit->id.'/edit') }}" class="btn btn-warning"> Editar Ganancia</a>
                    
                    <form action="{{ url('/profit/'.$profit->id ) }}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger"onclick="return confirm('¿Quieres borrar?')"> Borrar Ganancia</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>