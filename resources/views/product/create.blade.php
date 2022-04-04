<div class="container">
    <form action="{{ url('/products') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('product.form', ['mode'=>'Crear'])
    </form>
</div>
