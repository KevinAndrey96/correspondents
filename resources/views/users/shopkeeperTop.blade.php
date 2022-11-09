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
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Banners</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="my_table" class="table align-items-center mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tendero</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dinero movido</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Número de transacciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i = 0; $i < count($transactions); $i++)
                                    <tr class="align-middle text-center text-sm">
                                        <td>{{$shopkeepers[$i]->name}}</td>
                                        <td>${{number_format($transactions[$i]->acum, 2, ',', '.')}}</td>
                                        <td>{{$transactions[$i]->num_transactions}}</td>
                                    </tr>
                                @endfor
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
                "pageLength": 20,
                "paging": false,
                "aaSorting": [],
                "bDestroy": true,
            });
        } );
    </script>

@endsection
