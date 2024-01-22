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
                                        <label for="productType" class="ms-0">Seleccionar tipo de producto</label>
                                        @if (getenv('COUNTRY_NAME') == 'ECUADOR')
                                            <select id="productType" name="productType" class="form-control ms-0" aria-label="Default select example" onchange="showGirosInput()" required>
                                        @else
                                                <select id="productType" name="productType" class="form-control ms-0" aria-label="Default select example" required>
                                                @endif
                                            @if($mode=="Editar")
                                            @if($product->product_type == 'Deposit')
                                                <option value="Deposit">Depósito</option>
                                                <option value="Withdrawal">Retiro</option>
                                            @else
                                                <option value="Withdrawal">Retiro</option>
                                                <option value="Deposit">Depósito</option>
                                            @endif
                                        @else
                                            <option value="Withdrawal">Retiro</option>
                                            <option value="Deposit">Depósito</option>
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
                                        <label for="min_amount" class="form-label">Monto mínimo</label>
                                        <input type="number" class="form-control" name="min_amount" step="any" value="{{ isset($product->min_amount)?$product->min_amount:old('min_amount') }}" id="productMinAmount" placeholder="" min="0" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="max_amount" class="form-label">Monto máximo</label>
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
                                            <label for="num_jineteo" class="form-label">Transacciones por período</label>
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
                                @if (getenv('COUNTRY_NAME') == 'ECUADOR')
                                    @if ($mode=="Editar")
                                        @if ($product->product_type == 'Deposit' )
                                            <div class="col-md-3" id="girosDiv">
                                                @else
                                                    <div style="display:none;" class="col-md-3" id="girosDiv">
                                                        @endif
                                                        @else
                                                            <div style="display:none;" class="col-md-3" id="girosDiv">
                                                                @endif
                                                                <div class="input-group input-group-static mb-3">
                                                                    <label for="giros" class="ms-0">Giros</label>
                                                                    @if ($mode=="Editar")
                                                                        @if ($product->product_type == 'Deposit')
                                                                            <select id="giros" name="giros" class="form-control ms-0" aria-label="Default select example">
                                                                                @else
                                                                                    <select id="giros" name="giros" class="form-control ms-0" aria-label="Default select example" disabled>
                                                                                        @endif
                                                                                        @else
                                                                                            <select id="giros" name="giros" class="form-control ms-0" aria-label="Default select example" disabled>
                                                                                                @endif
                                                                                                @if($mode=="Editar")
                                                                                                    @if($product->giros == 1)
                                                                                                        <option Value=1>Si</option>
                                                                                                        <option Value=0>No</option>
                                                                                                    @else
                                                                                                        <option Value=0>No</option>
                                                                                                        <option Value=1>Si</option>
                                                                                                    @endif
                                                                                                @else
                                                                                                    <option Value=0>No</option>
                                                                                                    <option Value=1>Si</option>
                                                                                                @endif
                                                                                            </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="accountType" class="ms-0">¿Incluye tipo de cuenta?</label>
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
                                        <label for="email" class="ms-0">¿Incluye correo electrónico?</label>
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
                            </div>
                                                    <hr>

                                                    <div class="row mt-4 mb-4">
                                                        <div class="col-md-12">
                                                            <p style="font-size: 20px;" class="font-weight-bold ms-2 mt-3">Campos estandar de transacción</p>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="defaultFieldsRadio" value="1" id="enableDefaultFields" onchange="showDefaultFields(event)">
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Si
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="defaultFieldsRadio" value="0" id="disableDefaultFields" onchange="showDefaultFields(event)">
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <div style="display: none;" id="openFields" class="row">
                                                    <div class="col-md-12" id="openFieldsContainer">
                                                        @if ($mode == 'Crear' || $mode == 'Editar' && $product->are_default_fields)
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="col-md-7">
                                                                <div class="input-group input-group-outline my-3">
                                                                    <input type="text" style="font-size: 20px" class="form-control rounded border text-center" placeholder="Nombre del campo" name="fieldNames[]" id="fieldName" aria-label="fieldName" aria-describedby="basic-addon2" required>
                                                                    <div class="input-group-append mt-2 ps-2">
                                                                        <button class="btn btn-info" type="button" onclick="addField()"><i class="material-icons opacity-10">add</i></button>
                                                                        <button class="btn btn-danger" type="button"><i class="material-icons opacity-10">remove</i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                            @if ($mode == 'Editar' && ! $product->are_default_fields)
                                                                @for ($i = 0; $i < count($fieldNames); $i++)
                                                                    @if ($i == 0)
                                                                        <div class="row d-flex justify-content-center">
                                                                            <div class="col-md-7">
                                                                                <div class="input-group input-group-outline my-3">
                                                                                    <input type="text" style="font-size: 20px" class="form-control rounded border text-center" placeholder="Nombre del campo" name="fieldNames[]" id="fieldName" value="{{$fieldNames[$i]}}" aria-label="fieldName" aria-describedby="basic-addon2" required>
                                                                                    <div class="input-group-append mt-2 ps-2">
                                                                                        <button class="btn btn-info" type="button" onclick="addField()"><i class="material-icons opacity-10">add</i></button>
                                                                                        <button class="btn btn-danger" type="button"><i class="material-icons opacity-10">remove</i></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @else
                                                                        <div class="row d-flex justify-content-center">
                                                                            <div class="col-md-7">
                                                                                <div class="input-group input-group-outline my-3">
                                                                                    <input type="text" style="font-size: 20px" class="form-control rounded border text-center" placeholder="Nombre del campo" name="fieldNames[]" id="fieldName" value="{{$fieldNames[$i]}}" aria-label="fieldName" aria-describedby="basic-addon2" required>
                                                                                    <div class="input-group-append mt-2 ps-2">
                                                                                        <button class="btn btn-info" type="button" onclick="addField()"><i class="material-icons opacity-10">add</i></button>
                                                                                        <button class="btn btn-danger" type="button" onclick="removeField(event)"><i class="material-icons opacity-10">remove</i></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endfor
                                                            @endif
                                                    </div>
                                            </div>
                                <div style="display:none" id="defaultFields" class="row">
                                <div class="col-md-3">
                                    <div class="input-group input-group-static mb-3">
                                        <label for="clientDocument" class="ms-0">¿Incluye Documento o cedula del Cliente?</label>
                                        <select id="clientDocument" name="clientDocument" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()" disabled>
                                            @if ($mode == "Editar")
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
                                        <label for="extra" class="ms-0">¿Extra?</label>
                                        <select id="extra" name="extra" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()" disabled>
                                        @if($mode == "Editar")
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
                                        <label for="code" class="ms-0">¿Código?</label>
                                        <select id="code" name="code" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()" disabled>
                                        @if ($mode == "Editar")
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
                                        <label for="clientName" class="ms-0">¿Incluye nombre del cliente?</label>
                                        <select id="clientName" name="clientName" class="form-control ms-0" aria-label="Default select example" onchange="hiddenText()" disabled>
                                        @if ($mode == "Editar")
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
                                                    </div>
                                                <hr>
                                <div class="col-md-4">
                                    <div class="form-group mb-4 mt-5">
                                        <p style="font-size: 20px;" class="font-weight-bold ms-2 mt-3">Logo</p>
                                        <input type="file" class="form-control-file ms-3" name="image" value="" id="image">
                                    </div>
                                </div>
                                                <hr>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p style="font-size: 20px;" class="font-weight-bold ms-2 mt-3">Descripción</p>
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
    </script>
    <script type="text/javascript">
        function showGirosInput()
        {
            var productTypeInput = document.getElementById('productType');
            var girosInput = document.getElementById('giros');
            var girosDiv = document.getElementById('girosDiv');

            if (productTypeInput.value == 'Deposit') {
                girosDiv.style.display = 'block';
                girosInput.disabled = false;
            } else {
                girosDiv.style.display = 'none';
                girosInput.disabled = true;
            }

            console.log(girosInput.value)
        }

        function showDefaultFields(event)
        {
            let defaultFieldsDiv = document.getElementById('defaultFields');
            let openFieldsDiv = document.getElementById('openFields');
            let defaultFieldsDivChildNodes = defaultFieldsDiv.getElementsByTagName('*');
            let openFieldsDivChildNodes = openFieldsDiv.getElementsByTagName('*');

            for (let node of defaultFieldsDivChildNodes) {
                node.disabled = false;
            }

            for (let node of openFieldsDivChildNodes) {
                node.disabled = true;
            }

            openFieldsDiv.style.display = 'none';
            defaultFieldsDiv.style.display = 'block';

            if (event.target.value == '0')
            {
                defaultFieldsDiv.style.display = 'none';
                openFieldsDiv.style.display = 'block';

                for (let node of defaultFieldsDivChildNodes) {
                    node.disabled = true;
                }

                for (let node of openFieldsDivChildNodes) {
                    node.disabled = false;
                }
            }
        }

        function addField()
        {
            let openFieldsContainerDiv = document.getElementById('openFieldsContainer');
            let principalDiv = document.createElement('div');
            principalDiv.classList.add('row', 'd-flex', 'justify-content-center');

            let internalDiv = document.createElement('div');
            internalDiv.classList.add('col-md-7');

            let inputGroupDiv = document.createElement('div');
            inputGroupDiv.classList.add("input-group", "input-group-outline", "my-3");

            let fieldNameInput = document.createElement('input');
            fieldNameInput.type = 'text';
            fieldNameInput.style.fontSize = "20px";
            fieldNameInput.classList.add("form-control", "rounded", "border", "text-center");
            fieldNameInput.placeholder = "Nombre del campo";
            fieldNameInput.required = true;
            fieldNameInput.name = "fieldNames[]";
            fieldNameInput.id = "fieldName";
            fieldNameInput.setAttribute("aria-label", "fieldName");
            fieldNameInput.setAttribute("aria-describedby", "basic-addon2");

            let addButton = document.createElement('button');
            addButton.classList.add("btn", "btn-info");
            addButton.onclick = function() {
                addField();
            };

            addButton.type = "button";
            addButton.innerHTML = "<i class='material-icons opacity-10'>add</i>";

            let dropButton = document.createElement('button');
            dropButton.classList.add("btn", "btn-danger", "ms-1");
            dropButton.type = "button";
            dropButton.onclick = function() {
                removeField(event);
            }
            dropButton.innerHTML = "<i class='material-icons opacity-10'>remove</i>";

            let buttonsDiv = document.createElement("div");
            buttonsDiv.classList.add("input-group-append", "mt-2", "ps-2");

            buttonsDiv.append(addButton);
            buttonsDiv.append(dropButton);

            inputGroupDiv.appendChild(fieldNameInput);
            inputGroupDiv.appendChild(buttonsDiv);

            internalDiv.appendChild(inputGroupDiv);

            principalDiv.appendChild(internalDiv);

            openFieldsContainerDiv.appendChild(principalDiv);
        }

        function removeField(event)
        {
            let openFieldInput = event.target;
            let principalDiv = openFieldInput.parentNode.parentNode.parentNode.parentNode;
            principalDiv.remove();
        }
    </script>
@endsection

