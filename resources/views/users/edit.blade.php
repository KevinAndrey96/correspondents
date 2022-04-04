<form method="POST" action="/user/update">
    @csrf
    <label>Nombre:</label>
    <input type="text" name="name" value="{{$user->name}}">
    <br/>
    <br/>
    <label>Email:</label>
    <input type="email" name="email" value="{{$user->email}}">
    <br/>
    <br/>
    <label>Teléfono:</label>
    <input type="text" name="phone" value="{{$user->phone}}">
    <br/>
    <br/>
    <label>Tipo de documento:</label>
    <select name="document_type">
        @if ($user->document_type == 'CC')
            <option value="CC" selected>CC</option>
            <option value="TI">TI</option>
            <option value="NIT">NIT</option>
        @endif
            @if ($user->document_type == 'TI')
                <option value="TI" selected>TI</option>
                <option value="CI">CI</option>
                <option value="NIT">NIT</option>
            @endif
            @if ($user->document_type == 'NIT')
                <option value="NIT" selected>NIT</option>
                <option value="CI">CI</option>
                <option value="TI">TI</option>
            @endif
    </select>
    <br/>
    <br/>
    <label>Número de documento:</label>
    <input type="text" name="document" value="{{$user->document}}">
    <br/>
    <br/>
    <label>Ciudad:</label>
    <input type="text" name="city" value="{{$user->city}}">
    <br/>
    <br/>
    <label>Dirección:</label>
    <input type="text" name="address" value="{{$user->address}}">
    <br/>
    <br/>
    <label>Comisión:</label>
    <input type="number" name="commission" min="1" value="{{$user->commission}}">
    <br/>
    <br/>
    @if (isset($user->transaction_limit))
        <label>Límite de transacciones:</label>
        <input type="number" name="transaction_limit" min="1" value="{{$user->transaction_limit}}">
        <br/>
        <br/>
    @endif
    @if (isset($user->priority))
        <label>Prioridad</label>
        <input type="number" name="priority" min="1" value="{{$user->priority}}">
        <br/>
        <br/>
    @endif
    <label>Contraseña:</label>
    <input type="password" name="password">
    <br/>
    <br/>
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <input type="submit" value="Modificar">
</form>
