@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">payments</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Saldo en red</p>
                            <h4 class="mb-0">$15.5 M</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1"></div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">send</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">N° Movimientos</p>
                            <h4 class="mb-0">8300</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">group</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">N° Tenderos</p>
                            <h4 class="mb-0">3462</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">send</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Dinero en Op.</p>
                            <h4 class="mb-0">$753.000</h4>
                        </div>
                    </div>
                    <div class="card-footer p-1">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 ">Gestión de productos<a href="{{ url('products/create') }}" class="btn btn-block btn-Secondary"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">add_card</i></a></h6>

                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            @if(Session::has('mensaje'))
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    {{ Session::get('mensaje') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
                                </div>
                            @endif
                            <div class="table-responsive p-0">
                                <table id= "my_table" class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acción</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">nombre del producto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tipo del producto</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descripción del producto</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">activo?</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Documento</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tipo de cuenta</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">numero de cuenta</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">correo</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">nombre cliente</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">telefono</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">codigo</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">extra</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach( $products as $product )
                                        <tr>

                                            <td class="align-middle text-center text-sm">

                                                <a style="color: darkgreen;" href="{{ url('/products/'.$product->id.'/edit') }}" class="btn btn-link px-3 mb-0"><i style="color: darkgreen;" class="material-icons opacity-10">edit</i> Editar</a>

                                                <form action="{{ url('/products/'.$product->id ) }}" class="d-inline" method="post">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-link text-danger text-gradient px-1 mb-0" onclick="return confirm('¿Seguro que deseas eliminar el producto?')"><i style="color: red;" class="material-icons opacity-10">delete</i> Borrar</button>
                                                </form>
                                            </td>
                                            <td class="align-middle text-center text-sm">{{ $product->product_name}}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->product_type}}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->product_description}}</td>
                                            <td class="align-middle text-center text-sm">{{ ($product->is_enabled) ? 'Si' : 'No'}}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->name_field}}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->account_type}}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->account_number}}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->email}}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->client_name}}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->phone_number}}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->code}}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->extra}}</td>
                                            <td class="text-center">
                                                                                                    <!-- Button trigger modal -->
                                                    <button style="padding: 5px; font-size: 10px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModalMessage">Ver más</button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title font-weight-normal" id="exampleModalLabel">Datos de producto</h6>
                                                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form>
                                                                        <div class="input-group input-group-outline my-3">
                                                                            <label for="recipient-name" class="col-form-label"></label>
                                                                            <input type="text" class="form-control" id="recipient-name" placeholder="Dato 1:">
                                                                        </div>
                                                                        <div class="input-group input-group-outline my-3">
                                                                            <label for="recipient-name" class="col-form-label"></label>
                                                                            <input type="text" class="form-control" id="recipient-name" placeholder="Dato 2:">
                                                                        </div>
                                                                        <div class="input-group input-group-outline my-3">
                                                                            <label for="recipient-name" class="col-form-label"></label>
                                                                            <input type="text" class="form-control" id="recipient-name" placeholder="Dato 3:">
                                                                        </div>
                                                                    </form>
                                                                  </div>

                                                            </div>
                                                        </div>
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

@endsection
