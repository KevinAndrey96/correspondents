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
        <h3 class="p-2">Crear Roles</h3>
    </div>
    <div class="card-body">
        <div class="row justify-content-center" >
            <div class="col-auto mt-5">
                <form action="/role/store" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name_role">Nombre</label>
                            <input class="form-control" type="text" name="name_role" id="name_role" required>
                        </div>
                        <div class="form-group col-md-3">
                            <table class="table-responsive justify-content-center text-center" id=""  cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="padding:10px;" class="text-center text-md-center align-middle">Permiso</th>
                                        <th style="padding:10px;" class="text-center text-md-center align-middle">Selección</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td style="padding:10px;" class="text-center text-md-center align-middle">{{ $permission->name }}</td>
                                            <td style="padding:10px;" class="text-center text-md-center align-middle">
                                                <input type="checkbox" class="form-check-input" id="customCheck{{ $permission->id }}"
                                                       style="margin: 0px auto;" name="customCheck[]" value="{{ $permission->id }}"
                                                       onclick="getIDS({{ $permission->id }})">
                                                <label class="form-check-label" for="customCheck[]"></label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 text-center">
                            <input type="hidden" id="cart" name="cart">
                            <input class="btn btn-success btn-round align-middle mt-4" type="submit" value="Agregar">
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
