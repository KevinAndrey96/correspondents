@extends('layouts.dashboard')
@section('content')
    @if(Session::has('successfulGroupCommissionCreation'))
        <div class="alert alert-success" role="alert">
            <p class="text-center text-sm text-white">{{ Session::get('successfulGroupCommissionCreation') }}</p>
        </div>
    @endif

    <div class="row mt-4">
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Grupos de Comisiones<a
                                    href="{{route('commissions.create-group')}}" class="btn btn-block btn-Secondary"><i
                                        style="color: white; margin-top: 13px;" class="material-icons opacity-10">add_card</i></a>
                            </h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="my_table" class="table align-items-center mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Grupo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Comisiones
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Acción
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($commissionsGroups as $commissionsGroup)
                                    <tr class="align-middle text-center text-sm">
                                        <td class="font-weight-bold">
                                            {{$commissionsGroup->name}}
                                        </td>
                                        <td>
                                            <ul class="navbar-nav">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenucomm{{$commissionsGroup->id}}" aria-expanded="false" aria-controls="submenu-24">
                                                        <span class="nav-link-text text-white p-2 bg-info rounded">Ver comisiones</span>
                                                        <div id="submenucomm{{$commissionsGroup->id}}" class="collapse mt-3 border-2" data-bs-parent="#menu-accordion">
                                                            <ul class="submenu-list list-unstyled">
                                                                @foreach ($commissionsGroupGeneralCommissions as $item)
                                                                    @if ($item->comm_group_id == $commissionsGroup->id)
                                                                        <li class="nav-item">
                                                                            <span><strong>
                                                                                    {{strtoupper($item->generalCommission->product->product_name.' - '. ($item->generalCommission->product->product_type == 'Withdrawal' ? 'Retiro' : 'Deposito') )}}: ${{number_format($item->generalCommission->amount, 2, ',', '.')}}
                                                                                </strong>
                                                                            </span>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a style="color: darkgreen;" href="#" title="Editar" class="btn btn-link px-1 mb-0"><i style="color: darkgreen; font-size: 25px !important;" class="material-icons opacity-10">edit</i></a>
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
        $(document).ready(function () {
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
        });
    </script>
@endsection

