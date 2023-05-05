@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "> <a href=""
                                                                                              class="btn btn-block"><i style="color: white; margin-top: 13px;"
                                                                                                                       class="material-icons opacity-10">keyboard_return</i></a>Editar campos de producto</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                                <form action="{{route('product.fields-store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class=" input-group input-group-outline my-3">
                                                        <label for="productName" class="form-label">Nombre del producto</label>
                                                        <input type="text" class="form-control" name="product_name" value="{{$productFields->product_name}}" id="product_name" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class=" input-group input-group-outline my-3">
                                                        <label for="productName"  class="form-label"> Seleccionar tipo de producto</label>
                                                        <input type="text" class="form-control" name="product_type" value="{{$productFields->product_type}}" id="product_type" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="productCommission" class="form-label">Comisión del producto</label>
                                                        <input type="text" class="form-control" name="product_commission" value="{{$productFields->product_commission}}" id="product_commission" placeholder="" required>
                                                    </div>
                                                </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group input-group-outline my-3">
                                                            <label for="com_dis" class="form-label">Comisión del distribuidor</label>
                                                            <input type="text" class="form-control" name="com_dis" value="{{$productFields->com_dis}}" id="com_dis" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group input-group-outline my-3">
                                                            <label for="com_shp" class="form-label">Comisión del tendero</label>
                                                            <input type="text" class="form-control" name="com_shp" value="{{$productFields->com_shp}}" id="com_shp" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group input-group-outline my-3">
                                                            <label for="com_sup" class="form-label">Comisión del proveedor</label>
                                                            <input type="text" class="form-control" name="com_sup" value="{{$productFields->com_sup}}" id="com_sup" placeholder="">
                                                        </div>
                                                    </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="fixed_commission" class="form-label">Comisión fija</label>
                                                        <input type="text" class="form-control" name="fixed_commission" value="{{$productFields->fixed_commission}}" id="fixed_commission" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="productCommission" class="form-label">Monto mínimo</label>
                                                        <input type="text" class="form-control" name="min_amount" value="{{$productFields->min_amount}}" id="min_amount" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="productCommission" class="form-label">Monto máximo</label>
                                                        <input type="text" class="form-control" name="max_amount" value="{{$productFields->max_amount}}" id="max_amount" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="priority" class="form-label">Prioridad</label>
                                                        <input type="text" class="form-control" name="priority" value="{{$productFields->priority}}" id="priority" placeholder="" min="0" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="num_jineteo" class="form-label">Transacciones por periodo</label>
                                                        <input type="text" class="form-control" name="num_jineteo" value="{{$productFields->num_jineteo}}" id="numJineteo" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="productCommission" class="form-label">Período de tiempo (en horas)</label>
                                                        <input type="text" class="form-control" name="hours" value="{{$productFields->hours}}" id="hours" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="reassignment_minutes" class="form-label">Minutos para reasignar</label>
                                                        <input type="text" class="form-control" name="reassignment_minutes" value="{{$productFields->reassignment_minutes}}" id="reassignment_minutes" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="client_document" class="form-label">¿Incluye Documento del Cliente?</label>
                                                        <input type="text" class="form-control" name="client_document" value="{{$productFields->client_document}}" id="client_document" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="account_type" class="form-label">¿Incluye tipo de cuenta?</label>
                                                        <input type="text" class="form-control" name="account_type" value="{{$productFields->account_type}}" id="account_type" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="email" class="form-label">¿Incluye correo electrónico?</label>
                                                        <input type="text" class="form-control" name="email" value="{{$productFields->email}}" id="email" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="extra" class="form-label">¿Incluye información extra?</label>
                                                        <input type="text" class="form-control" name="extra" value="{{$productFields->extra}}" id="extra" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="code" class="form-label">¿Incluye código?</label>
                                                        <input type="text" class="form-control" name="code" value="{{$productFields->code}}" id="code" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="product_logo" class="form-label">Logo:</label>
                                                        <input type="text" class="form-control" name="product_logo" value="{{$productFields->product_logo}}" id="product_logo" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="input-group input-group-outline my-3">
                                                        <label for="product_description" class="form-label">Descripción:</label>
                                                        <input type="text" class="form-control" name="product_description" value="{{$productFields->product_description}}" id="product_description" placeholder="" required>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="d-flex justify-content-center mt-4">
                                            <input type="submit" class="btn btn-success bg-gradient" value="Guardar">
                                        </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
