@extends('layouts.dashboard')
@section('content')
    <div class="row mt-4">
    </div>
    @if(Session::has('cardCreationSuccess'))
        <div class="alert alert-success" role="alert">
            <p class="text-center text-white">{{ Session::get('cardCreationSuccess') }}</p>
        </div>
    @endif
    @if(Session::has('CardDeleteSuccess'))
        <div class="alert alert-success" role="alert">
            <p class="text-center text-white">{{ Session::get('CardDeleteSuccess') }}</p>
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Tarjetas de recaudo<a href="{{ route('cards.create') }}" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">add_card</i></a></h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id= "my_table" class="table align-items-center mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Imagen</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cards as $card)
                                    <tr class="align-middle text-center text-sm">
                                        <td>
                                            <a class="image-link" href="{{$urlServer.$card->cardIMG }}">
                                                <img width="200px" class="rounded img-fluid m-4" src="{{ getenv('URL_SERVER').$card->cardIMG  }}">
                                            </a>
                                        </td>
                                        <td>
                                            <a style="color: darkgreen;" href="{{route('cards.delete',['id'=>$card->id])}}"
                                               title="Detalle" class="btn btn-link px-3 mb-0"
                                               onclick="return confirm('¿Esta seguro que quiere borrar esta tarjeta?');">
                                                <i style="color: darkred;" class="material-icons opacity-10">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready( function () {
            $('#my_table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "=>",
                        "previous": "<="
                    }
                },
                responsive: true,
                "pageLength": 20
            });
        } );
    </script>

@endsection
