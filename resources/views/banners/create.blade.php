@extends('layouts.dashboard')
@section('content')
    @if(count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    @if ($error == 'role es requerido')
                        <li>El rol es requerido</li>
                    @endif
                    @if ($error == 'El campo image debe ser un archivo de tipo: jpg, jpeg, png.')
                        <li>Ingrese una imagen con un formato valido</li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="{{ route('banners.create') }}" class="btn btn-block"></a> Crear Banner</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="{{route('banners.store')}}" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Seleccione un Rol:</label>
                                            <select class="form-control text-center" name="role">
                                                <option value="administrator">Administrador</option>
                                                <option value="distributor">Distribuidor</option>
                                                <option value="supplier">Proveedor</option>
                                                <option value="shopkeeper">Tendero</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="image" >Seleccione un Banner:</label>
                                        <input style="border: gray 0.5px solid; border-radius: 20px" type="file" class="form-control form-control-sm" name="image" value="" id="image">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success bg-gradient m-4 float-end" value="Crear">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
