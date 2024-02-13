@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Asignación de distribuidor<a href="{{ route('cards.create') }}" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">add_card</i></a></h6>
                        </div>
                    </div>
                    <div class="card-body px-3 pb-2">
                        <form method="POST" action="{{route('users.store-distributor-change')}}">
                            <div class="table-responsive p-0">
                                <table id= "my_table" class="table align-items-center table-striped mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Selección</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Distribuidor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($distributors as $distributor)
                                            @if ($shopkeeper->distributor_id != $distributor->id)
                                                <tr class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    <td>
                                                        <div class="form-check ps-0 pe-0">
                                                            <input class="form-check-input border-dark" type="radio" name="distributorID" id="distributorID" value="{{$distributor->id}}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                       <p class="text-uppercase">{{$distributor->name}}</p>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="shopkeeperID" value="{{$shopkeeper->id}}">
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <input type="submit" class="btn btn-primary btn-gradient" value="Asignar">
                                </div>
                            </div>
                        </form>
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
                "pageLength": 10
            });
        } );
    </script>

@endsection
