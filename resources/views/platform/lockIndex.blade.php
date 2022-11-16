@extends('layouts.dashboard')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 ">Bloquear plataforma</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form id="form-status" method="POST" action="{{route('platform.lock')}}" enctype="multipart/form-data">
                                <div class="row justify-content-center">
                                    @csrf
                                    <div class="col-md-12 col-sm-12">
                                        <p style="text-align: center;">
                                            Si quiere activar o desactivar la plataforma tiene que seleccionar el siguiente
                                            control hacia la opción que desee, en este momento la plataforma se encuentra:
                                            <strong>
                                                @if ($platform->is_enabled == 1)
                                                    ACTIVA
                                                @else
                                                    BLOQUEADA
                                                @endif
                                            </strong>

                                        </p>
                                    </div>
                                        <div style="width: 10%;" class="col-md-12 pe-6 col-sm-12 form-check form-switch align-middle text-center">
                                            @if ($platform->is_enabled == 1)
                                                <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{$platform->id}}" checked onchange="getStatus({{$platform->id}})">
                                                <label class="form-check-label text-body ms-0 text-truncate w-80 mb-0" for="togglestatus{{$platform->id}}"></label>
                                            @else
                                                <input class="form-check-input ms-auto" type="checkbox" id="togglestatus{{$platform->id}}" onchange="getStatus({{$platform->id}})">
                                                <label class="form-check-label text-body ms-0 text-truncate w-0 mb-80" for="togglestatus{{$platform->id}}"></label>
                                            @endif
                                        </div>
                                </div>
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="status" id="status">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getStatus(id)
        {
            let text = "¿Está seguro que desea continuar con esta acción?";
            if (confirm(text) === true) {
                let toggle = document.getElementById("togglestatus" + id);
                let status = document.getElementById("status");
                let form = document.getElementById("form-status");
                let platform_id = document.getElementById("id");

                if (toggle.checked === true) {
                    status.value = 1;
                } else {
                    status.value = 0;
                }
                platform_id.value = id;
                form.submit();
            }
        }
    </script>
@endsection
