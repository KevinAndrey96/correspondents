<h1>{{ $mode }} producto </h1>

@if(count($errors)>0)

    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach( $errors->all() as $error )
            <li> {{ $error }} </li>
        @endforeach
        </ul>
    </div>    

@endif

<div class="form-group">
    <label for="productName"> Nombre del producto </label>
    <input type="text" class="form-control" name="productName" value="{{ isset($product->product_name)?$product->product_name:old('product_name') }}" id="productName" placeholder="Nombre del producto">
</div>

<div class="form-group">
    <label for="productType"> Tipo del producto </label>
    <input type="text" class="form-control" name="productType" value="{{ isset($product->product_type)?$product->product_type:old('product_type') }}" id="productType" placeholder="Tipo del producto">
</div>

<div class="form-group">
    <label for="productDescription"> Descripción del producto </label>
    <input type="text" class="form-control" name="productDescription" value="{{ isset($product->product_description)?$product->product_description:old('product_description') }}" id="productDescription" placeholder="Descripción del producto">
</div>

@if($mode=="Editar")
<div>
    <label for="isEnabled"> Desactivar producto</label>
    <select id="isEnabled" name="isEnabled" class="form-selelct" aria-label="Default select example" onchange="hiddenText()">
        <option Value=1>
            No
        </option>
        <option Value=0>
            Si
        </option>
    </select>
</div>
@endif

<div>
    <label for="nameField"> ¿Incluye nombre?</label>
    <select id="namefield" name="nameField" class="form-selelct" aria-label="Default select example" onchange="hiddenText()">
        <option Value=1>
            Si
        </option>
        <option Value=0>
            No
        </option>
    </select>
</div>

<div>
    <label for="accountType"> ¿Incluye tipo de cuenta?</label>
    <select id="accountType" name="accountType" class="form-selelct" aria-label="Default select example" onchange="hiddenText()">
        <option Value=1>
            Si
        </option>
        <option Value=0>
            No
        </option>
    </select>
</div>

<div>
    <label for="accountNumber"> ¿Incluye número de cuenta?</label>
    <select id="accountNumber" name="accountNumber" class="form-selelct" aria-label="Default select example" onchange="hiddenText()">
        <option Value=1>
            Si
        </option>
        <option Value=0>
            No
        </option>
    </select>
</div>

<div>
    <label for="email"> ¿Incluye correo electronico?</label>
    <select id="email" name="email" class="form-selelct" aria-label="Default select example" onchange="hiddenText()">
        <option Value=1>
            Si
        </option>
        <option Value=0>
            No
        </option>
    </select>
</div>

<div>
    <label for="clientName"> ¿Incluye nombre del cliente?</label>
    <select id="clientName" name="clientName" class="form-selelct" aria-label="Default select example" onchange="hiddenText()">
        <option Value=1>
            Si
        </option>
        <option Value=0>
            No
        </option>
    </select>
</div>

<div>
    <label for="phoneNumber"> ¿Incluye número telefonico?</label>
    <select id="phoneNumber" name="phoneNumber" class="form-selelct" aria-label="Default select example" onchange="hiddenText()">
        <option Value=1>
            Si
        </option>
        <option Value=0>
            No
        </option>
    </select>
</div>

<div>
    <label for="code"> ¿Incluye codigo?</label>
    <select id="code" name="code" class="form-selelct" aria-label="Default select example" onchange="hiddenText()">
        <option Value=1>
            Si
        </option>
        <option Value=0>
            No
        </option>
    </select>
</div>

<div>
    <label for="extra"> ¿Incluye informacion extra?</label>
    <select id="extra" name="extra" class="form-selelct" aria-label="Default select example" onchange="hiddenText()">
        <option Value=1>
            Si
        </option>
        <option Value=0>
            No
        </option>
    </select>
</div>

<br>
<input class="btn btn-success" type="submit" value="{{ $mode }} datos">

<a class="btn btn-primary" href="{{ url('/product') }}"> Regresar</a>