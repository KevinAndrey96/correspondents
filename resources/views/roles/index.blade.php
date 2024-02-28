@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-primary bg-gradient shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize  mx-6 ">
                                Roles <a href="#" id="btn-add" class="btn pl-1 pt-1" ><i style="color: white; margin-top: 13px;" class="material-icons opacity-10 p-0">add</i></a>
                            </h6>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="row d-flex justify-content-center">
                                <input type="hidden" name="roleID" id="roleID" required>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <div class="table-responsive">
                                                <table id="my_table" class="table table-striped table-hover dt-responsive display nowrap"
                                                       width="100%" cellspacing="0">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th style="padding:10px;" class="text-center text-md-center align-middle">Nombre</th>
                                                        <th style="padding:10px;" class="text-center text-md-center align-middle">Acción</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text-center text-md-center align-middle">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-->
    <div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Editar rol</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span id="closeEditRoleModal" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="number">Nombre</label>
                                <input class="form-control border ps-2" type="text" name="name" id="nameEdit" required>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center mt-4">
                                <input type="submit" class="btn btn-success" id="btn-update" value="Modificar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal-->
    <!-- Modal-->
    <div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Crear rol</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span id="closeCreateRoleModal" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="number">Nombre</label>
                                <input class="form-control border ps-2" type="text" name="name" id="nameCreate" required>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center mt-4">
                                <input type="submit" class="btn btn-success" id="btn-store" value="Crear">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal-->
    <!-- Modal-->
    <div class="modal fade draggable resizable" id="assignPermissionsRoleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Asignar permisos</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span id="closeAssignPermissionsRoleModal" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div style="overflow-y: scroll;" class="row">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal-->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#my_table').DataTable({
                ajax: {
                    "url": "{{route('roles.getAll')}}",
                    "debug": true,
                },
                columns: [
                    {data: 'name'},
                    {data: 'id', render: function(data, type, row) {
                            return '<div class="d-flex justify-content-center">' +
                                '<div class="d-inline">' +
                                '<a style="color: green;" href="#" title="Editar" class="btn btn-link px-1 mb-0" onclick="setEditFields('+data+')">' +
                                '<i style="color: green; font-size: 25px !important;" class="material-icons opacity-10">' +
                                'edit</i></a>'+
                                '</div>'+
                                '<div class="d-flex justify-content-center">' +
                                '<div class="d-inline">' +
                                '<a style="color: darkblue;" href="#" title="Asignar permisos" class="btn btn-link px-1 mb-0" onclick="setAssignPermissionsModal('+data+')">' +
                                '<i style="color: darkblue; font-size: 25px !important;" class="material-icons opacity-10">' +
                                'assignment_turned_in</i></a>'+
                                '</div>'+
                                '</div>';
                        }}
                ],
                success: function(){

                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                "paging": false,
            });

            $("#my_table").dataTable().fnDestroy();

            $('#assignPermissionsRoleModal').draggable();

            $('#btn-add').on('click', function(){
                $('#createRoleModal').modal('show');
            });

            $('#closeAssignPermissionsRoleModal').on('click', function(){
                $('#assignPermissionsRoleModal').modal('hide');
            })

            $('#closeAssignPermissionsRoleModal').hover(function(){
                $(this).css('cursor', 'pointer');
            })

            $('#closeCreateRoleModal').on('click', function(){
                $('#createRoleModal').modal('hide');
            })

            $('#closeCreateRoleModal').hover(function(){
                $(this).css('cursor', 'pointer');
            })

            $('#closeEditRoleModal').on('click', function(){
                $('#editRoleModal').modal('hide');
            })

            $('#closeEditRoleModal').hover(function(){
                $(this).css('cursor', 'pointer');
            })

            $('#btn-store').on('click', function(){
                var data = {
                    name: $('#nameCreate').val()
               };

                $('#my_table').DataTable({
                    ajax: {
                        "url": "{{getenv('APP_URL')}}/api/role-store",
                        "type": "POST",
                        "data": data,
                        "debug": true,
                    },
                    columns: [
                        {data: 'name'},
                        {data: 'id', render: function(data, type, row) {
                                return '<div class="d-flex justify-content-center">' +
                                    '<div class="d-inline">' +
                                    '<a style="color: green;" href="#" title="Editar" class="btn btn-link px-1 mb-0" onclick="setEditFields('+data+')">' +
                                    '<i style="color: green; font-size: 25px !important;" class="material-icons opacity-10">' +
                                    'edit</i></a>'+
                                    '</div>'+
                                    '<div class="d-flex justify-content-center">' +
                                    '<div class="d-inline">' +
                                    '<a style="color: darkblue;" href="#" title="Asignar permisos" class="btn btn-link px-1 mb-0" onclick="setAssignPermissionsModal('+data+')">' +
                                    '<i style="color: darkblue; font-size: 25px !important;" class="material-icons opacity-10">' +
                                    'assignment_turned_in</i></a>'+
                                    '</div>'+
                                    '</div>';
                            }}
                    ],
                    success: function(){

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                    "bDestroy": true

                });
                $('#createRoleModal').modal('hide');
            });
            $("#my_table").dataTable().fnDestroy();

            $('#btn-update').on('click', function(){
                var data = {
                    name: $('#nameEdit').val(),
                    id: $('#roleID').val(),
                };

                $('#my_table').DataTable({
                    ajax: {
                        "url": "{{route('roles.update')}}",
                        "type": "POST",
                        "data": data,
                        "debug": true,
                    },
                    columns: [
                        {data: 'name'},
                        {data: 'id', render: function(data, type, row) {
                                return '<div class="d-flex justify-content-center">' +
                                    '<div class="d-inline">' +
                                    '<a style="color: green;" href="#" title="Editar" class="btn btn-link px-1 mb-0" onclick="setEditFields('+data+')">' +
                                    '<i style="color: green; font-size: 25px !important;" class="material-icons opacity-10">' +
                                    'edit</i></a>'+
                                    '</div>'+
                                    '<div class="d-flex justify-content-center">' +
                                    '<div class="d-inline">' +
                                    '<a style="color: darkblue;" href="#" title="Asignar permisos" class="btn btn-link px-1 mb-0" onclick="setAssignPermissionsModal('+data+')">' +
                                    '<i style="color: darkblue; font-size: 25px !important;" class="material-icons opacity-10">' +
                                    'assignment_turned_in</i></a>'+
                                    '</div>'+
                                    '</div>';
                            }}
                    ],
                    success: function(){

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                    "bDestroy": true

                });
                $('#editRoleModal').modal('hide');
            });

            $("#my_table").dataTable().fnDestroy();
        });

        function setEditFields(id)
        {
            $.ajax({
                url: '/api/get-role-register/'+id,
                type: 'GET',
                success: function(response) {
                    $('#nameEdit').val(response.data.attributes.name);
                    $('#roleID').val(response.data.attributes.id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('ha ocurrido un error');
                }
            });
            $('#editRoleModal').modal('show');
        }

        function setAssignPermissionsModal(id)
        {
            $.ajax({
                url: '/api/get-role-register/'+id,
                type: 'GET',
                success: function(response) {
                    var permissions = response.meta.all_permissions;
                    var assignedPermissions = response.data.relationships.permissions.data;
                    $('#roleID').val(id);
                    var html = '';

                    $.each(permissions, function(index, permission) {
                        var checked = '';
                        if ($.inArray(permission.id, assignedPermissions) !== -1) {
                            checked = 'checked';
                        }
                        html += '<div class="col-md-4">';
                        html += '<div class="form-group form-check ps-1 w-100">';
                        html += '<input class="form-check-input mt-2" style="transform: scale(1)" type="checkbox" name="permissionIDs" id="permissionIDs" value="' + permission.id + '" ' + checked + '>';
                        html += '<label class="form-check-label font-weight-bold ms-2 mt-1" style="font-size: 100%; ' +
                            'text-transform: uppercase; overflow: hidden; word-break: break-word !important;" for="permissions"><span style="font-size: 80%">' + permission.name + '</span></label>';
                        html += '</div>';
                        html += '</div>';
                    })
                    html += '<div class="col-md-12 d-flex justify-content-center mt-4">'+
                        '<input type="submit" class="btn btn-success" id="btn-assign" onclick="sendPermissionsIDs('+id.toString()+')" value="Asignar">'+
                        '</div>'


                    $('#assignPermissionsRoleModal .row').html(html);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('ha ocurrido un error');
                }
            });
            $('#assignPermissionsRoleModal').modal('show');
        }


        function sendPermissionsIDs(id)
        {
            var data = {
                roleID: id,
                //permissionIDs: $('#permissionIDs').val()
                permissionIDs: $('input[name="permissionIDs"]:checked').map(function() {
                    return $(this).val();
                }).get()
            };

            $('#my_table').DataTable({
                ajax: {
                    "url": "{{route('roles.savePermissionAssignments')}}",
                    "type": "POST",
                    "data": data,
                    "debug": true,
                },
                columns: [
                    {data: 'name'},
                    {data: 'id', render: function(data, type, row) {
                            return '<div class="d-flex justify-content-center">' +
                                '<div class="d-inline">' +
                                '<a style="color: green;" href="#" title="Editar" class="btn btn-link px-1 mb-0" onclick="setEditFields('+data+')">' +
                                '<i style="color: green; font-size: 25px !important;" class="material-icons opacity-10">' +
                                'edit</i></a>'+
                                '</div>'+
                                '<div class="d-flex justify-content-center">' +
                                '<div class="d-inline">' +
                                '<a style="color: darkblue;" href="#" title="Asignar permisos" class="btn btn-link px-1 mb-0" onclick="setAssignPermissionsModal('+data+')">' +
                                '<i style="color: darkblue; font-size: 25px !important;" class="material-icons opacity-10">' +
                                'assignment_turned_in</i></a>'+
                                '</div>'+
                                '</div>';
                        }}
                ],
                success: function(){

                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                "bDestroy": true

            });
            $('#assignPermissionsRoleModal').modal('hide');

        }

    </script>



@endsection
