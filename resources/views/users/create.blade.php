<form method="POST" action="/user/store">
    @csrf
    <label>Nombre:</label>
    <input type="text" name="name">
    <br/>
    <br/>
    <label>Email:</label>
    <input type="email" name="email">
    <br/>
    <br/>
    <label>Teléfono:</label>
    <input type="text" name="phone">
    <br/>
    <br/>
    <label>Tipo de documento:</label>
    <select name="document_type">
        <option value="CC">CC</option>
        <option value="TI">TI</option>
        <option value="NIT">NIT</option>
    </select>
    <br/>
    <br/>
    <label>Número de documento:</label>
    <input type="text" name="document">
    <br/>
    <br/>
    <label>Ciudad:</label>
    <input type="text" name="city">
    <br/>
    <br/>
    <label>Dirección:</label>
    <input type="text" name="address">
    <br/>
    <br/>
    <label>Comisión:</label>
    <input type="number" name="commission" min="1">
    <br/>
    <br/>
    <label>Saldo:</label>
    <input type="number" name="balance" min="1">
    <br/>
    <br/>
    @if ($role == 'Supplier')
        <label>Prioridad</label>
        <input type="number" name="priority" min="1">
        <br/>
        <br/>
        <label>Maxima cola de transacciones:</label>
        <input type="number" name="max_queue" min="1">
        <br/>
        <br/>
    @endif
    <label>Contraseña:</label>
    <input type="password" name="password">
    <br/>
    <br/>
    <input type="hidden" value="{{$role}}" name="role">
    <input type="submit" value="Guardar">
</form>
