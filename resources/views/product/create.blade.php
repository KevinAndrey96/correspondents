<div class="container">
    <form action="{{ url('/product') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('product.form', ['mode'=>'Crear'])
    </form>
</div>