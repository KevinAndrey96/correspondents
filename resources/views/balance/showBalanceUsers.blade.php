<div class="container">
    <br/>
    <table id= "my_table" class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Saldo Actual</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $users as $user )
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->balance }}</td>
                <td>
                    <a href="{{ url('/balance/add/'.$user->id) }}" class="btn btn-warning"> G. saldo</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>