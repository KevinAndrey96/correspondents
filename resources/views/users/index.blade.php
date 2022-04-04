<a href="/user/create?role={{$role}}">
        @if ($role == 'Administrator')
            Crear administrador
        @endif
        @if ($role == 'Supplier')
            Crear proveedor
        @endif
        @if ($role == 'Shopkeeper')
            Crear tendero
        @endif

</a>
    <table style="border:1px solid black;">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Tipo de documento</th>
                <th>Número de documento</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Comisión</th>
                @if ($role == 'Shopkeeper')
                    <th>Límite de transacciones</th>
                @endif
                @if ($role == 'Supplier')
                    <th>Prioridad</th>
                @endif
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->document_type}}</td>
                    <td>{{$user->document}}</td>
                    <td>{{$user->city}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->commission}}</td>
                    @if ($role == 'Shopkeeper')
                        <td>{{$user->transaction_limit}}</td>
                    @endif
                    @if ($role == 'Supplier')
                        <td>{{$user->priority}}</td>
                    @endif
                    <td>
                        <a href="/user/edit/{{$user->id}}">Editar</a>
                        <br>
                        <a href="/user/delete/{{$user->id}}">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

