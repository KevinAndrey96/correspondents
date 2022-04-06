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
            @if ($role == 'Distributor')
                Crear distribuidor
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
                <th>Saldo</th>
                @if ($role == 'Supplier')
                    <th>Cola maxima</th>
                    <th>Prioridad</th>
                @endif
                <th>Estado</th>
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
                    <td>{{$user->balance}}</td>
                    @if ($role == 'Supplier')
                        <td>{{$user->max_queue}}</td>
                        <td>{{$user->priority}}</td>
                    @endif
                    <td>
                        @if ($user->is_enabled == 1)
                            Habilitado
                        @else
                            Deshabilitado
                        @endif
                    </td>
                    <td>
                        @if ($user->is_enabled == 1)
                            <input style="width: 50px; height:30px;" data-toggle="toggle"
                                   id="togglestatus{{$user->id}}" type="checkbox" checked onchange="getStatus({{$user->id}})">
                            <br/>
                        @else
                            <input style="width: 50px; height:30px;" data-toggle="toggle"
                                   id="togglestatus{{$user->id}}" type="checkbox" onchange="getStatus({{$user->id}})">
                            <br/>
                        @endif
                        <a href="/user/edit/{{$user->id}}">Editar</a>
                        <br>
                        <a href="/user/delete/{{$user->id}}" onclick="return confirm('¿Está seguro que quiere eliminar este usuario?');">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form id="form-status" name="form-status" method="POST" action="/changeStatusUser">
        @csrf
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="status" id="status">
    </form>
<script>
    function getStatus(id)
    {
        var toggle = document.getElementById("togglestatus"+id);
        var status = document.getElementById("status");
        var form = document.getElementById("form-status");
        var user_id = document.getElementById("id");

        if (toggle.checked == true) {
            status.value = 1;
        } else {
            status.value = 0;
        }
        user_id.value = id;
        form.submit();
    }
</script>

