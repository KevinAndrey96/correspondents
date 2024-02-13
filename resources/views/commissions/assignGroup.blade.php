@extends('layouts.dashboard')
@section('content')
    @if(Session::has('noChecked'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('noChecked') }}
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="/users?role=Distributor" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a>Assignar grupo de comisiones</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="{{route('commissions.store-group-assignment')}}" enctype="multipart/form-data">
                                <div class="row mt-3">
                                    @csrf
                                    @if (Auth::user()->role == 'Administrator')
                                        <p style="font-size: 20px;" class="font-weight-bold ms-2 mt-3">Seleccione el grupo:</p>
                                        <div class="col-md-12 ms-2">
                                            <select class="form-select border ps-2" name="commissionsGroupID" id="commissionsGroupsSelect" aria-label="Default select example" onchange="showCommissions()">
                                                @foreach ($commissionsGroups as $commissionsGroup)
                                                    <option value="{{$commissionsGroup->id}}"><span class="ms-4">{{$commissionsGroup->name}}</span></option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @foreach ($commissionsGroups as $index => $commissionsGroup)
                                        <div style="@if ($index == 0) display:block; @else  display:none; @endif"  id="commissionsGroup{{$commissionsGroup->id}}" class="col-md-12 ms-2 mt-4 commissionsGroups">
                                            <div class="row">
                                                @foreach ($commissionsGroupGeneralCommissions as $item)
                                                    @if ($item->comm_group_id == $commissionsGroup->id)
                                                        <div class="col-md-6 text-center mb-3">
                                                            <div class="w-100 border border-4 border-primary">
                                                                <p class="font-weight-bold text-center">{{strtoupper($item->generalCommission->product->product_name.' - '. ($item->generalCommission->product->product_type == 'Withdrawal' ? 'Retiro' : 'Deposito'))}}</p>
                                                                <p class="text-center">COMISIÓN DISTRIBUIDOR: ${{number_format($item->generalCommission->amount_dis, 2, ',', '.')}}</p>
                                                                <p class="text-center">COMISIÓN TENDERO: ${{number_format($item->generalCommission->amount_shop, 2, ',', '.')}}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                <input type="hidden" name="userID" value="{{$userID}}">
                                <div class="row mt-4 mb-4">
                                    <div class="col-md-12 mt-3 d-flex justify-content-center">
                                        <input type="submit" class="btn btn-success bg-gradient m-4 float-end" value="Asignar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function showCommissions()
        {
            let commissionsGroupsSelect = document.getElementById('commissionsGroupsSelect');
            let commissionsGroupDiv = document.getElementById('commissionsGroup'+commissionsGroupsSelect.value);
            let commissionsGroupsDivs = document.querySelectorAll('.commissionsGroups');

            commissionsGroupsDivs.forEach(function(commissionsGroupDiv){
                commissionsGroupDiv.style.display = 'none';
            });

            commissionsGroupDiv.style.display = 'block';
        }
    </script>
@endsection

