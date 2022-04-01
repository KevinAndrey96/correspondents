<div class="container">
    <form action="{{ url('/profit') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('profit.form', ['mode'=>'Crear'])
    </form>
</div>
