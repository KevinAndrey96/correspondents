<div class="container">
    
    @if(Session::has('mensaje'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
        </div>
    @endif
        
    <a href="{{ url('product/create') }}" class="btn btn-success" > Crear producto </a>
    <br/>
    <br/>
    <table id= "my_table" class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>nombre del producto</th>
                <th>tipo del producto</th>
                <th>Descripción del producto</th>
                <th>activo?</th>
                <th>nombre</th>
                <th>tipo de cuenta</th>
                <th>numero de cuenta</th>
                <th>correo</th>
                <th>nombre cliente</th>
                <th>telefono</th>
                <th>codigo</th>
                <th>extra</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach( $products as $product )
            <tr>
                <td>{{ $product->product_name}}</td>
                <td>{{ $product->product_type}}</td>
                <td>{{ $product->product_description}}</td>
                <td>{{ $product->is_enabled}}</td>
                <td>{{ $product->name_field}}</td>
                <td>{{ $product->account_type}}</td>
                <td>{{ $product->account_number}}</td>
                <td>{{ $product->email}}</td>
                <td>{{ $product->client_name}}</td>
                <td>{{ $product->phone_number}}</td>
                <td>{{ $product->code}}</td>
                <td>{{ $product->extra}}</td>
                <td>
                    <a href="{{ url('/product/'.$product->id.'/edit') }}" class="btn btn-warning"> Editar producto</a>
                    
                    <form action="{{ url('/product/'.$product->id ) }}" class="d-inline" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger"onclick="return confirm('¿Quieres borrar?')"> Borrar producto</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
