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
                                        <li><p class="text-center text-sm text-white"> {{ $error }} </p></li>
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
                                        <input type="text" class="form-control" name="productName" value="{{ isset($product->product_name)?$product->product_name:old('product_name') }}" id="productName" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="productType" class="ms-0"> Seleccionar tipo de producto</label>
                                        <select id="productType" name="productType" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()" required>
                                        @if($mode=="Editar")
                                            @if($product->product_type == 'Deposit')
                                            <option value="Deposit">Depósito</option>
                                            <option value="Withdrawal">Retiro</option>
                                            @else
                                            <option value="Withdrawal">Retiro</option>
                                            <option value="Deposit">Depósito</option>
                                            @endif
                                        @else
                                            <option value="Deposit">Depósito</option>
                                            <option value="Withdrawal">Retiro</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="productCommission" class="form-label">Comisión del producto</label>
                                        <input type="number" class="form-control" step="any" name="productCommission" value="{{ isset($product->product_commission)?$product->product_commission:old('product_commission') }}" id="productCommission" placeholder="" required>
                                    </div>
                                </div>
                                @if ($mode == 'Crear')
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="com_dis" class="form-label">Comisión del distribuidor</label>
                                        <input type="number" class="form-control" step="any" min="0" name="com_dis" value="{{ isset($product->com_shop)?$product->com_shop:old('com_shop') }}" id="com_dis" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="com_shp" class="form-label">Comisión del tendero</label>
                                        <input type="number" class="form-control" step="any" min="0" name="com_shp" value="{{ isset($product->com_shop)?$product->com_shop:old('com_shop') }}" id="com_shp" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="com_sup" class="form-label">Comisión del proveedor</label>
                                        <input type="number" class="form-control" step="any" min="0" name="com_sup" value="{{ isset($product->com_shop)?$product->com_shop:old('com_shop') }}" id="com_sup" placeholder="">
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="fixed_commission" class="form-label">Comisión fija</label>
                                        <input type="number" class="form-control" step="any" min="0" name="fixed_commission" value="{{ isset($product->fixed_commission)?$product->fixed_commission:old('fixed_commission') }}" id="fixed_commission" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="productCommission" class="form-label">Monto mínimo</label>
                                        <input type="number" class="form-control" name="min_amount" step="any" value="{{ isset($product->min_amount)?$product->min_amount:old('min_amount') }}" id="productMinAmount" placeholder="" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="productCommission" class="form-label">Monto máximo</label>
                                        <input type="number" class="form-control" name="max_amount" step="any" value="{{ isset($product->max_amount)?$product->max_amount:old('max_amount') }}" id="productMaxAmount" placeholder="" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="priority" class="form-label">Prioridad</label>
                                        <input type="number" class="form-control" name="priority" value="{{ isset($product->priority)?$product->priority:old('priority') }}" id="priority" placeholder="" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                            <label for="num_jineteo" class="form-label">Transacciones por periodo</label>
                                        <input type="number" class="form-control" name="num_jineteo" value="{{ isset($product->num_jineteo)?$product->num_jineteo:old('num_jineteo') }}" id="numJineteo" placeholder="" min="1" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="productCommission" class="form-label">Período de tiempo (en horas)</label>
                                        <input type="number" class="form-control" name="hours" value="{{ isset($product->hours)?$product->hours:old('hours') }}" id="hours" placeholder="" min="1" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="productCommission" class="form-label">Minutos para reasignar</label>
                                        <input type="number" class="form-control" name="reassignment_minutes" value="{{ isset($product->reassignment_minutes)?$product->reassignment_minutes:old('reassignment_minutes') }}" id="reassignment_minutes" placeholder="" min="2" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-3">
                                        <label for="clientDocument" class="ms-0"> ¿Incluye Documento del Cliente?</label>
                                        <select id="clientDocument" name="clientDocument" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                        @if($mode=="Editar")
                                            @if($product->client_document == 1)
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                            @else
                                            <option Value=0>No</option>
                                            <option Value=1>Si</option>
                                            @endif
                                        @else
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="accountType" class="ms-0"> ¿Incluye tipo de cuenta?</label>
                                        <select id="accountType" name="accountType" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                        @if($mode=="Editar")
                                            @if($product->account_type == 1)
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                            @else
                                            <option Value=0>No</option>
                                            <option Value=1>Si</option>
                                            @endif
                                        @else
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="email" class="ms-0"> ¿Incluye correo electrónico?</label>
                                        <select id="email" name="email" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                        @if($mode=="Editar")
                                            @if($product->email == 1)
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                            @else
                                            <option Value=0>No</option>
                                            <option Value=1>Si</option>
                                            @endif
                                        @else
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="extra" class="ms-0"> ¿Incluye información extra?</label>
                                        <select id="extra" name="extra" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                        @if($mode=="Editar")
                                            @if($product->extra == 1)
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                            @else
                                            <option Value=0>No</option>
                                            <option Value=1>Si</option>
                                            @endif
                                        @else
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="code" class="ms-0"> ¿Incluye código?</label>
                                        <select id="code" name="code" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                        @if($mode=="Editar")
                                            @if($product->code == 1)
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                            @else
                                            <option Value=0>No</option>
                                            <option Value=1>Si</option>
                                            @endif
                                        @else
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="clientName" class="ms-0"> ¿Incluye nombre del cliente?</label>
                                        <select id="clientName" name="clientName" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()">
                                        @if($mode=="Editar")
                                            @if($product->client_name == 1)
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                            @else
                                            <option Value=0>No</option>
                                            <option Value=1>Si</option>
                                            @endif
                                        @else
                                            <option Value=1>Si</option>
                                            <option Value=0>No</option>
                                        @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="image">Logo:</label>
                                        <input type="file" class="form-control-file" name="image" value="" id="image">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="productDescription">Descripción:</label>
                                        <textarea class="form-control" name="productDescription" id="richText" required>
                                            {{ isset($product->product_description)?$product->product_description:old('product_description') }}
                                        </textarea>
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
    <script type="text/javascript">
        var comShpInput = document.getElementById('com_shp');
        var comDisInput = document.getElementById('com_dis');
        var comSupInput = document.getElementById('com_sup');
        var comProdInput = document.getElementById('productCommission');

                comProdInput.addEventListener('input', function(){
                    comDisInput.max = comProdInput.value;
                    console.log(comDisInput.max);
                });
        /*
                comDisInput.addEventListener('input', function(){
                    comShpInput.max = comDisInput.value;

                });


                comShpInput.addEventListener('input', function(){
                    comShpInput.value


                });

                comSupInput.addEventListener('input', function(){

                });
                */
    </script>
@endsection

