<form method="POST" action="/updatePassword">
    @csrf
    <div class="form-group">
        <label for="oldPass"><p style="font-weight:bold">Digite su antigua contraseña:</p></label>
        <input class="form-control" name="oldPass" type="password" required>
    </div>
    <div class="form-group" style="margin-top:20px">
        <label for="newPass1"><p style="font-weight:bold">Digite su nueva contraseña:</p></label>
        <input class="form-control" name="newPass1" type="password" required>
    </div>
    <div class="form-group" style="margin-top:20px">
        <label for="newPass2"><p style="font-weight:bold">Digite otra vez su nueva contraseña:</p></label>
        <input class="form-control" name="newPass2" type="password" required>
    </div>
    <br/>
    <input type="submit" class="btn btn-primary" value="Modificar">
</form>
