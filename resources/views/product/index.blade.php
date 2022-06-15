@extends('layouts.dashboard')
@section('content')
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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">BLOQ/DESBL</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acción</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Logo</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">nombre del producto</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tipo del producto</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comisión</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descripción del producto</th>
                                        <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">activo?</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Documento</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">tipo de cuenta</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">numero de cuenta</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">correo</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">nombre cliente</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">telefono</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">codigo</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">extra</th>-->

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach( $products as $product )
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                @if ($product->is_enabled == 1)
                                                    <span class="badge badge-sm bg-gradient-success">OnLine</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">OffLine</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center text-sm ps-0">                                                
                                                <div class="form-check form-switch align-middle text-center">
                                                    @if ($product->is_enabled == 1)
                                                        <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{$product->id}}" checked onchange="getStatus({{$product->id}})">
                                                        <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="togglestatus{{$product->id}}"></label>
                                                    @else
                                                        <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{$product->id}}" onchange="getStatus({{$product->id}})">
                                                        <label class="form-check-label text-body ms-0 text-truncate w-0 mb-80" for="togglestatus{{$product->id}}"></label>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a style="color: darkgreen;" href="{{ url('/products/'.$product->id.'/edit') }}" class="btn btn-link px-3 mb-0"><i style="color: darkgreen;" class="material-icons opacity-10">edit</i> Editar</a>
                                                <!--<form action="{{ url('/products/'.$product->id ) }}" class="d-inline" method="post">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-link text-danger text-gradient px-1 mb-0" onclick="return confirm('¿Seguro que deseas eliminar el producto?')"><i style="color: red;" class="material-icons opacity-10">delete</i> Borrar</button>
                                                </form>-->
                                                <button style="padding: 6px; font-size: 11px; margin-top: 12px; margin-left: 10px; " type="button" class="btn btn-dark" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalMessage"
                                                        data-whatever="{{ $product->product_name}}"
                                                        data-email="{{ $product->email }}"
                                                        data-type="{{ $product->product_type}}"
                                                        data-enabled="{{ ($product->is_enabled) }}"
                                                        data-account_number="{{ $product->account_number }}"
                                                        data-account_type="{{ $product->account_type }}"
                                                        data-client_name="{{ $product->client_name }}"
                                                        data-phone_number="{{ $product->phone_number }}"
                                                        data-code="{{ $product->code }}"
                                                        data-extra="{{ $product->extra }}"
                                                        data-commission="{{ $product->product_commission }}"

                                                >Ver</button>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if(isset($product->product_logo))
                                                <div>
                                                    <img style="border: 1px solid #010101;" class="avatar avatar-sm rounded-circle " src="{{ 'https://corresponsales.asparecargas.net/'.$product->product_logo }}" alt="No carga">
                                                </div>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center text-sm">{{ $product->product_name}}</td>
                                            @if($product->product_type=='Deposit')
                                                <td class="align-middle text-center text-sm">Deposito</td>
                                            @else
                                                <td class="align-middle text-center text-sm">Retiro</td>
                                            @endif
                                            <td class="align-middle text-center text-sm">{{ $product->product_commission }}</td>
                                            <td class="align-middle text-center text-sm">{{ $product->product_description}}</td>
                                        </tr>
                                    @endforeach
                                    <form id="form-status" name="form-status" method="POST" action="/changeStatusProduct">
                                        @csrf
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="status" id="status">
                                    </form>
                                    <script>
                                        function getStatus(id)
                                        {
                                            var toggle = document.getElementById("togglestatus"+id);
                                            var status = document.getElementById("status");
                                            var form = document.getElementById("form-status");
                                            var product_id = document.getElementById("id");

                                            if (toggle.checked == true) {
                                                status.value = 1;
                                            } else {
                                                status.value = 0;
                                            }
                                            product_id.value = id;
                                            form.submit();
                                        }
                                    </script>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="exampleModalLabel">Product</h6>
                                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                       <div class="row pb-2">
                                                        <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                            <div class="card">
                                                                <div class="card-header p-0 ">
                                                                    <div class="icon icon-x icon-shape bg-gradient-primary shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                        <i class="material-icons opacity-10">email</i>
                                                                    </div>
                                                                    <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                        <label for="recipient-email" id="product-email" class="col-form-label">Correo:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer p-1"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                            <div class="card">
                                                                <div class="card-header p-0 ">
                                                                    <div class="icon icon-x icon-shape bg-gradient-dark shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                        <i class="material-icons opacity-10">credit_card</i>
                                                                    </div>
                                                                    <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                        <label for="recipient-type" id="product-type" class="col-form-label">T. Producto:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer p-1"></div>
                                                            </div>
                                                        </div>
                                                       </div>
                                                       <div class="row pb-2">
                                                        <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                            <div class="card">
                                                                <div class="card-header p-0 ">
                                                                    <div class="icon icon-x icon-shape bg-gradient-primary shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                        <i class="material-icons opacity-10">account_balance</i>
                                                                    </div>
                                                                    <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                        <label for="recipient-account_type" id="product-account_type" class="col-form-label">T. cuenta:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer p-1"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                            <div class="card">
                                                                <div class="card-header p-0 ">
                                                                    <div class="icon icon-x icon-shape bg-gradient-dark shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                        <i class="material-icons opacity-10">notifications_active</i>
                                                                    </div>
                                                                    <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                        <label for="recipient-enabled" id="product-enabled" class="col-form-label">Activo: </label>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer p-1"></div>
                                                            </div>
                                                        </div>
                                                       </div>
                                                       <div class="row pb-2">
                                                        <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                            <div class="card">
                                                                <div class="card-header p-0 ">
                                                                    <div class="icon icon-x icon-shape bg-gradient-primary shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                        <i class="material-icons opacity-10">pin</i>
                                                                    </div>
                                                                    <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                        <label for="recipient-account_number" id="product-account_number" class="col-form-label">N° cuenta:</label>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer p-1"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                            <div class="card">
                                                                <div class="card-header p-0 ">
                                                                    <div class="icon icon-x icon-shape bg-gradient-dark shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                        <i class="material-icons opacity-10">person</i>
                                                                    </div>
                                                                    <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                        <label for="recipient-client_name" id="product-client_name" class="col-form-label">Nombre cliente: </label>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer p-1"></div>
                                                            </div>
                                                        </div>
                                                       </div>
                                                       <div class="row pb-2">
                                                            <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                                <div class="card">
                                                                    <div class="card-header p-0 ">
                                                                        <div class="icon icon-x icon-shape bg-gradient-primary shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                            <i class="material-icons opacity-10">add_circle_outline</i>
                                                                        </div>
                                                                        <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                            <label for="recipient-extra" id="product-extra" class="col-form-label">Extra:</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer p-1"></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                                <div class="card">
                                                                    <div class="card-header p-0 ">
                                                                        <div class="icon icon-x icon-shape bg-gradient-dark shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                            <i class="material-icons opacity-10">code</i>
                                                                        </div>
                                                                        <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                            <label for="recipient-code" id="product-code" class="col-form-label">Código: </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer p-1"></div>
                                                                </div>
                                                            </div>
                                                       </div>
                                                       <div class="row pb-2">
                                                            <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                            <!--<div class="card">
                                                                <div class="card-header p-0 ">
                                                                        <div class="icon icon-x icon-shape bg-gradient-primary shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                            <i class="material-icons opacity-10">phone_forwarded</i>
                                                                        </div>
                                                                        <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                            <label for="recipient-phone_number" id="product-phone_number" class="col-form-label">N° Teléfono:</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer p-1"></div>
                                                                </div>-->
                                                            </div>
                                                            <div class="col-xl-6 col-sm-4 mb-xl-0 pb-3">
                                                                <div class="card">
                                                                    <div class="card-header p-0 ">
                                                                        <div class="icon icon-x icon-shape bg-gradient-dark shadow-dark text-center border-radius-xxl mt-n0 position-absolute">
                                                                               <i class="material-icons opacity-10">attach_money</i>
                                                                        </div>
                                                                        <div style="margin-bottom: -15px; margin-left: 32px;" class="text-center p-1 mt-2">
                                                                               <label for="recipient-commission" id="product-commission" class="col-form-label">comisión:</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-footer p-1"></div>
                                                                </div>
                                                            </div>
                                                       </div>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $('#exampleModalMessage').on('show.bs.modal', function (event) {
                                            /*var button = $(event.relatedTarget)  // Button that triggered the modal
                                            var recipient = button.data('whatever') // Extract info from data-* attributes
                                            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                                            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

                                            modal.find('.modal-title').text('New message to ' + recipient)
                                            modal.find('.modal-body input').val(recipient)*/
                                            var button = $(event.relatedTarget)
                                            var whatever = button.data('whatever')
                                            var modal = $(this)

                                            var email = button.data('email')
                                            var tipo = button.data('type')
                                            var enabled = button.data('enabled')
                                            var account_number = button.data('account_number')
                                            var account_type = button.data('account_type')
                                            var client_name = button.data('aclient_name')
                                            //var phone_number = button.data('phone_number')
                                            var code = button.data('code')
                                            var extra = button.data('extra')
                                            var commission = button.data('commission')

                                            modal.find('.modal-title').text('Producto ' + whatever)
                                            modal.find('#product-email').text('Correo: ' + (email == 1 ? 'Si' : 'No'))
                                            modal.find('#product-type').text('T. Producto: ' + (tipo == 'Deposit' ? 'Depósito' : 'Retiro'))
                                            modal.find('#product-enabled').text('Activo: ' + (enabled ? 'Si' : 'No'))
                                            modal.find('#product-account_number').text('N° Cuenta: ' + (account_number ? 'Si' : 'No' ))
                                            modal.find('#product-account_type').text('T. Cuenta: ' + (account_type ? 'Si' : 'No' ))
                                            modal.find('#product-client_name').text('Cliente: ' + (client_name ? 'No' : 'Si' ))
                                            //modal.find('#product-phone_number').text('Teléfono: ' + (phone_number ? 'Si' : 'No' ))
                                            modal.find('#product-code').text('Código: ' + (code ? 'Si' : 'No' ))
                                            modal.find('#product-extra').text('Extra: ' + (extra ? 'Si' : 'No' ))
                                            modal.find('#product-commission').text('Comisión: ' + (commission ))


                                        })
                                    </script>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
