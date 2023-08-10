@extends('layouts.dashboard')
@section('content')
    <div class="row mt-4">
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Marcas blancas<a href="{{route('brands.create')}}" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">add_card</i></a></h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id= "my_table" class="table align-items-center mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dominio</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Logo cuadrado</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Logo rectangular</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $brand)
                                    <tr class="align-middle text-center text-sm">
                                        <td>{{$brand->domain}}</td>
                                        <td>
                                            <a class="image-link" href="{{getenv('URL_SERVER').$brand->square_logo_url}}">
                                                <img width="20%" class="img-fluid" src="{{getenv('URL_SERVER').$brand->square_logo_url}}">
                                            </a>
                                        </td>
                                        <td>
                                            <a class="image-link" href="{{getenv('URL_SERVER').$brand->rectangular_logo_url}}">
                                                <img width="20%" class="img-fluid" src="{{getenv('URL_SERVER').$brand->rectangular_logo_url}}">
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a style="color: darkgreen;" href="{{route('brands.edit', ['id' => $brand->id])}}" title="Editar" class="btn btn-link px-1 mb-0"><i style="color: darkgreen; font-size: 25px !important;" class="material-icons opacity-10">edit</i></a>
                                            </div>
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
