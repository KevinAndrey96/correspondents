@extends('layouts.dashboard')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                        <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href="{{ url('products') }}" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a> {{ $mode }} producto </h6>
                    </div>
                </div>
                <div class="card-body px-2 pb-2">
                    <div class="container">
                        @if(count($errors)>0)
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach( $errors->all() as $error )
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="productName" class="form-label"></label>
                                        <input type="text" class="form-control" name="productName" value="{{ isset($product->product_name)?$product->product_name:old('product_name') }}" id="productName" placeholder="Nombre del producto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline  my-3">
                                        <label for="productType" class="form-label">Tipo del producto</label>
                                        <input type="text" class="form-control" name="productType" value="{{ isset($product->product_type)?$product->product_type:old('product_type') }}" id="productType">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline  my-3">
                                        <label for="productDescription" class="form-label">Descripción del producto</label>
                                        <input type="text" class="form-control" name="productDescription" value="{{ isset($product->product_description)?$product->product_description:old('product_description') }}" id="productDescription">
                                    </div>
                                </div>
                                @if($mode=="Editar")
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="isEnabled"> Desactivar producto</label>
                                        <select id="isEnabled" name="isEnabled" class="form-control" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>No</option>
                                            <option Value=0>Si</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="nameField" class="ms-0"> ¿Incluye nombre?</label>
                                        <select id="namefield" name="nameField" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="accountType" class="ms-0"> ¿Incluye tipo de cuenta?</label>
                                        <select id="accountType" name="accountType" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="accountNumber" class="ms-0"> Incluye número de cuenta?</label>
                                        <select id="accountNumber" name="accountNumber" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="email" class="ms-0"> ¿Incluye correo electronico?</label>
                                        <select id="email" name="email" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="extra" class="ms-0"> ¿Incluye informacion extra?</label>
                                        <select id="extra" name="extra" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="phoneNumber" class="ms-0"> ¿Incluye número telefonico?</label>
                                        <select id="phoneNumber" name="phoneNumber" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="code" class="ms-0"> ¿Incluye codigo?</label>
                                        <select id="code" name="code" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="clientName" class="ms-0"> ¿Incluye nombre del cliente?</label>
                                        <select id="clientName" name="clientName" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">

                                    <input class="btn btn-primary " type="submit" value="{{ $mode }} datos">

                                    <a class="btn btn-info" href="{{ url('/products') }}"> Regresar</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
