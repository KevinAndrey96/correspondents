<h2>Por favor seleccione un usuario</h2>
@if (Auth::user()->role == 'Administrator')
    <h3>Distribuidores</h3>
    @foreach ($users as $user)
        @if($user->role == 'Distributor')
            <a href="/commissions/create/{{$user->id}}">{{$user->name}}</a>
            <br/>
        @endif
    @endforeach
    <h3>Proveedores</h3>
    @foreach ($users as $user)
        @if($user->role == 'Supplier')
            <a href="/commissions/create/{{$user->id}}">{{$user->name}}</a>
            <br/>
        @endif
    @endforeach
@endif
@if (Auth::user()->role == 'Distributor')
    <h3>Tenderos</h3>
    @foreach ($users as $user)
        @if ($user->role == 'Shopkeeper')
            <a href="/commissions/create/{{$user->id}}">{{$user->name}}</a>
            <br/>
        @endif
    @endforeach
@endif
