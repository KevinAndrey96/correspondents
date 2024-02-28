@extends('layouts.dashboard')
@section('content')

        @if(Session::has('adminrecepSuccess'))
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="alert alert-success" role="alert">
                {{ Session::get('adminrecepSuccess') }}
            </div>
            </div>
        @endif

    <div class="card">
        <div class="card-header text-center">
            <h3 class="p-2">Crear Permisos</h3>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-auto mt-2">
                    <form action="/permission/store" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name_permission">Nombre</label>
                                <input class="form-control" type="text" name="name_permission" id="name_permission" required>
                            </div>
                            <div class="col-md-6 text-center">
                                <input class="btn btn-success btn-round mt-4 align-middle" style="width:300px;" type="submit" value="Agregar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var ids = new Array();

        function getIDS(permissionID)
        {
            var box = document.getElementById("customCheck"+permissionID);
            var cart = document.getElementById("cart");
            if (box.checked == true) {
                ids.push(permissionID);
            } else {
                var i = ids.indexOf(permissionID);
                if ( i !== -1 ) {
                    ids.splice( i, 1 );
                }

                //ids.pop(permissionID);
            }
            var selections = Object.assign({},ids);
            cart.value = ids;

        }
    </script>
@endsection
