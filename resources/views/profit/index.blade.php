@extends('layouts.dashboard')
@section('content')
    <div class="row mt-4">
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        @if ((Auth::user()->role == 'Shopkeeper' || Auth::user()->role == 'Distributor') && isset(Auth::user()->brand_id))
                            <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Ganancias</h6>
                            </div>
                        @else
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Ganancias</h6>
                            </div>
                        @endif
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if(Session::has('mensaje'))
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                {{ Session::get('mensaje') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
                            </div>
                        @endif
                        <div class="table-responsive p-0">
                            <table id="my_table" class="table align-items-center mb-0">
                                <thead class="thead-light">
                                <tr>
                                    @hasrole('Administrator')
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Administrador</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Saldo Acumulado</th>
                                    @endhasrole
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° de Solicitud  </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Monto a retirar</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">¿Es valido?</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recibo</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach( $profits as $profit )
                                    <tr>
                                        @hasrole('Administrator')
                                        <td class="align-middle text-center text-sm">{{ $profit->user->name}}</td>
                                        <td class="align-middle text-center text-sm">
                                            @if (isset($profit->administrator))
                                                {{$profit->administrator->name}}
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">${{number_format($profit->user->profit, 2, ',', '.')}}</td>
                                        @endhasrole
                                        <td class="align-middle text-center text-sm">{{ $profit->id}}</td>
                                        <td class="align-middle text-center text-sm">${{number_format($profit->amount, 2, ',', '.')}}</td>
                                        <td class="align-middle text-center text-sm">{{ $profit->date}}</td>
                                        @if($profit->is_valid == 0)
                                        <td class="align-middle text-center text-sm">No</td>
                                        @else
                                        <td class="align-middle text-center text-sm">Si</td>
                                        @endif
                                        <td class="align-middle text-center text-sm">
                                            @if(isset($profit->boucher))
                                            <div>
                                                <a class="image-link" href="{{getenv('URL_SERVER') }}{{$profit->boucher }}">
                                                    <img style="border: 1px solid #010101;" class="avatar avatar-sm rounded-circle " src="{{getenv('URL_SERVER')}}{{$profit->boucher }}" alt="No carga">
                                                </a>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <style>
                                .form-control {
                                    background-color: #f2f2f2 !important ;
                                }
                            </style>
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
                                        "aaSorting": [],
                                        "bDestroy": true
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
