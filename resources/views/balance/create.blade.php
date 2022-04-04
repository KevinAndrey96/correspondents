<div class="container">
    <form action="{{ url('/balance') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('balance.form', ['mode'=>'Crear'])
    </form>
</div>
