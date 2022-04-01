
<div class="container">
    <form action="{{ url('/balance/'.$balance->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('PATCH') }}
        @include('balance.form', ['mode'=>'Editar'])
    </form>
</div>
