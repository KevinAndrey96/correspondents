
<div class="container">
    <form action="{{ url('/products/'.$product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('product.form', ['mode'=>'Editar'])
    </form>
</div>
