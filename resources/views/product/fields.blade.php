@extends('layouts.dashboard')
@section('content')
    @if(Session::has('modifiedFields'))
        <div class="alert alert-success" role="alert">
            <p style="color:white;" class="m-auto">{{ Session::get('modifiedFields') }}</p>
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Campos de producto</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id= "my_table" class="table align-items-center mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Campos</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle text-center text-sm">
                                        <td>
                                            @if (isset($productFields))
                                                <ul>
                                                    @foreach ($productFields->getAttributes() as $index => $field)
                                                        @if ($index != 'id' && $index != 'created_at' && $index != 'updated_at')
                                                            @if (! is_null($field))
                                                                <li>{{$field}}</li>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a style="color: darkgreen;" href="{{route('product.fields-edit')}}" title="Editar" class="btn btn-link px-1 mb-0"><i style="color: darkgreen; font-size: 25px !important;" class="material-icons opacity-10">edit</i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
