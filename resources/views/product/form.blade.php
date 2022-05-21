@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                        <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href="{{ url('products') }}"
                          class="btn btn-block"><i style="color: white; margin-top: 13px;"
                               class="material-icons opacity-10">keyboard_return</i></a> {{ $mode }} producto </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
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
                            @if($mode=="Crear")
                        <form action="{{ url('/products') }}" method="post" enctype="multipart/form-data">
                            @elseif($mode=="Editar")
                        <form action="{{ url('/products/'.$product->id) }}" method="post" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="productName" class="form-label">Nombre del producto</label>
                                        <input type="text" class="form-control" name="productName" value="{{ isset($product->product_name)?$product->product_name:old('product_name') }}" id="productName" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="productType" class="ms-0"> Tipo del producto</label>
                                        <select id="productType" name="productType" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option value="">Seleccionar opción</option>
                                            <option value="Deposit">Depósito</option>
                                            <option value="Withdrawal">Retiro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class=" input-group input-group-outline my-3">
                                        <label for="productCommission" class="form-label">Comisión del producto</label>
                                        <input type="text" class="form-control" name="productCommission" value="{{ isset($product->product_commission)?$product->product_commission:old('product_commission') }}" id="productCommission" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline  my-3">
                                        <label for="productDescription" class="form-label">Descripción del producto</label>
                                        <input type="text" class="form-control" name="productDescription" value="{{ isset($product->product_description)?$product->product_description:old('product_description') }}" id="productDescription" placeholder="">
                                    </div>
                                </div>
                                @if($mode=="Editar")
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="isEnabled"> Desactivar producto</label>
                                        <select id="isEnabled" name="isEnabled" class="form-control" aria-label="Default select example" onchange="hiddenText()">
                                            <option value="1">No</option>
                                            <option value="0">Si</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="clientDocument" class="ms-0"> ¿Incluye Documento del Cliente?</label>
                                        <select id="clientDocument" name="clientDocument" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
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
                                        <label for="email" class="ms-0"> ¿Incluye correo electrónico?</label>
                                        <select id="email" name="email" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="extra" class="ms-0"> ¿Incluye información extra?</label>
                                        <select id="extra" name="extra" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="code" class="ms-0"> ¿Incluye código?</label>
                                        <select id="code" name="code" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label for="image">Logo</label>
                                        @if(isset($product->product_logo))
                                            <img style="border: 1px solid #000;" class="img-thumbnail img-fluid border-radius-lg" src="{{ 'https://corresponsales.asparecargas.net/'.$product->product_logo }}" height="35px" width="35px" alt="No carga">
                                        @endif
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
                                <div class="col-md-4">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="image">Logo</label>
                                        <input type="file" class="form-control-file" name="image" value="" id="image">
                                    </div>
                                </div>
                                <div class="text-center">

                                    <input class="btn btn-primary" type="submit" value="{{ $mode }}">

                                    <a class="btn btn-info" href="{{ url('/products') }}"> Regresar</a>
                                </div>
                            </div>
                        </form>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

