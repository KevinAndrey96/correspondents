@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-primary bg-gradient shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize  mx-6 ">
                               Permisos <a href="#" id="btn-add" class="btn pl-1 pt-1" ><!--<i style="color: white; margin-top: 13px;" class="material-icons opacity-10 p-0">add</i>--></a>
                            </h6>
                        </div>
                        <div id="cardBody" class="card-body px-0 pb-2">
                            <div class="row d-flex justify-content-center">
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
    <div class="modal fade" id="editPermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Editar permiso</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span id="closeEditPermissionModal" aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="number">Nombre</label>
                                <input class="form-control border ps-2" type="text" name="name" id="nameEdit" required>
                            </div>
                            <input type="hidden" name="permissionID" id="permissionID" required>
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
    <div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Crear permiso</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span id="closeCreatePermissionModal" aria-hidden="true">×</span>
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
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Asignar roles</h6>
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
                    "url": "{{getenv('APP_URL')}}/api/get-all-permissions",
                    "debug": true,
                },
                columns: [
                    {data: 'name'},
                    {data: 'id', render: function(data, type, row) {
                            return '<div class="d-flex justify-content-center">' +
                                '<div class="d-inline">' +
                                '<!--<a style="color: green;" hphp aref="#" title="Editar" class="btn btn-link px-1 mb-0" onclick="setEditFields('+data+')">' +
                                '<i style="color: green; font-size: 25px !important;" class="material-icons opacity-10">' +
                                'edit</i></a>-->'+
                                '</div>'+
                                '<div class="d-flex justify-content-center">' +
                                '<div class="d-inline">' +
                                '<a style="color: darkblue;" href="#" title="Asignar roles" class="btn btn-link px-1 mb-0" onclick="setAssignRolesModal('+data+')">' +
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

            $('#btn-add').on('click', function(){
                $('#createPermissionModal').modal('show');
            });

            $('#btn-store').on('click', function(){
                var data = {
                    name: $('#nameCreate').val()
                };

                $('#my_table').DataTable({
                    ajax: {
                        "url": "{{route('permissions.store')}}",
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
                                    '<a style="color: darkblue;" href="#" title="Asignar roles" class="btn btn-link px-1 mb-0" onclick="setAssignRolesModal('+data+')">' +
                                    '<i style="color: darkblue; font-size: 25px !important;" class="material-icons opacity-10">' +
                                    'assignment_turned_in</i></a>'+
                                    '</div>'+
                                    '</div>'
                            }}
                    ],
                    success: function(){

                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                    "bDestroy": true

                });
                $('#createPermissionModal').modal('hide');
            });
            $("#my_table").dataTable().fnDestroy();

            $('#btn-update').on('click', function(){
                var data = {
                    name: $('#nameEdit').val(),
                    id: $('#permissionID').val(),
                };

                $('#my_table').DataTable({
                    ajax: {
                        "url": "{{route('permissions.update')}}",
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
                                    '<a style="color: darkblue;" href="#" title="Asignar roles" class="btn btn-link px-1 mb-0" onclick="setAssignRolesModal('+data+')">' +
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
                $('#editPermissionModal').modal('hide');
            });
            $("#my_table").dataTable().fnDestroy();

            //$('#assignPermissionsRoleModal').resizable();
            $('#assignPermissionsRoleModal').draggable();


            $('#closeAssignPermissionsRoleModal').on('click', function(){
                $('#assignPermissionsRoleModal').modal('hide');
            })

            $('#closeAssignPermissionsRoleModal').hover(function(){
                $(this).css('cursor', 'pointer');
            })

            $('#closeCreatePermissionModal').on('click', function(){
                $('#createPermissionModal').modal('hide');
            })

            $('#closeCreatePermissionModal').hover(function(){
                $(this).css('cursor', 'pointer');
            })

            $('#closeEditPermissionModal').on('click', function(){
                $('#editPermissionModal').modal('hide');
            })

            $('#closeEditPermissionModal').hover(function(){
                $(this).css('cursor', 'pointer');
            })
        });

        function setEditFields(id)
        {
            $.ajax({
                url: '{{getenv('APP_URL')}}/api/get-permission-register/'+id,
                type: 'GET',
                success: function(response) {
                    $('#nameEdit').val(response.data.attributes.name);
                    $('#permissionID').val(response.data.attributes.id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('ha ocurrido un error');
                }
            });
            $('#editPermissionModal').modal('show');
        }

        function setAssignRolesModal(id)
        {
            $.ajax({
                url: '/api/get-permission-register/'+id,
                type: 'GET',
                success: function(response) {
                    var roles = response.meta.all_roles;
                    var assignedRoles = response.data.relationships.roles.data;
                    var html = '';

                    $.each(roles, function(index, role) {
                        var checked = '';
                        if ($.inArray(role.id, assignedRoles) !== -1) {
                            checked = 'checked';
                        }
                        html += '<div class="col-md-4">';
                        html += '<div class="form-group form-check">';
                        html += '<input class="form-check-input mt-2" style="transform: scale(1)" type="checkbox" name="roleIDs" id="roleIDs" value="' + role.id + '" ' + checked + '>';
                        html += '<label class="form-check-label font-weight-bold ms-2 mt-1" style="font-size: 100%;' +
                            'text-transform: uppercase; overflow: hidden; word-break: break-word !important;" for="roles"><span style="font-size: 80%">' + role.name + '</span></label>';
                        html += '</div>';
                        html += '</div>';

                    })
                    html += '<div class="col-md-12 d-flex justify-content-center mt-4">'+
                        '<input type="submit" class="btn btn-success" id="btn-assign" onclick="sendRolesIDs('+id.toString()+')" value="Asignar">'+
                        '</div>'


                    $('#assignPermissionsRoleModal .row').html(html);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('ha ocurrido un error');
                }
            });
            $('#assignPermissionsRoleModal').modal('show');

        }

        function sendRolesIDs(id)
        {
            var data = {
                permissionID: id,
                //permissionIDs: $('#permissionIDs').val()
                roleIDs: $('input[name="roleIDs"]:checked').map(function() {
                    return $(this).val();
                }).get()
            };

            $('#my_table').DataTable({
                ajax: {
                    "url": "{{route('permissions.saveRoleAssignments')}}",
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
                                '<a style="color: darkblue;" href="#" title="Asignar roles" class="btn btn-link px-1 mb-0" onclick="setAssignRolesModal('+data+')">' +
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
