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
                        @if (isset(Auth::user()->brand_id))
                        <div style="background-image: linear-gradient(195deg, {{Auth::user()->brand->primary_color}} 0%, #191919 100%);" class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                            <h6 class="text-white text-center text-capitalize ps-2 mx-6"><a href="/users?role=Distributor" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a>Asignar Productos</h6>
                        </div>
                        @else
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 "><a href="/users?role=Distributor" class="btn btn-block"><i style="color: white; margin-top: 13px;" class="material-icons opacity-10">keyboard_return</i></a>Asignar Productos</h6>
                            </div>
                        @endif
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="container">
                            <form method="POST" action="{{route('product.store.assignments')}}" enctype="multipart/form-data">
                                <div class="row">
                                    @csrf
                                    @if (Auth::user()->role == 'Administrator')
                                            @foreach($products as $product)
                                                <div class="col-md-4 form-check mt-4">
                                                    <input style=""type="checkbox" class="form-check-input" name="products[]"
                                                           value="{{$product->id}}"
                                                           @foreach($supplierProducts as $sProduct)
                                                               @if($sProduct->product_id == $product->id)
                                                                    checked
                                                               @break
                                                               @endif
                                                           @endforeach
                                                    >
                                                    <label>{{$product->product_name}} -
                                                        @if($product->product_type == 'Deposit')
                                                            DEPOSITO
                                                        @else
                                                            RETIRO
                                                        @endif
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif

                                    @if (Auth::user()->role == 'Distributor')
                                        @foreach ($distributorProducts as $distributorProduct)
                                            @if (! $distributorProduct->product->is_deleted)
                                            <div class="col-md-4 form-check mt-4">
                                                <input style=""type="checkbox" class="form-check-input" name="products[]"
                                                       value="{{$distributorProduct->product->id}}"
                                                        @foreach ($supplierProducts as $sProduct)
                                                            @if ($sProduct->product_id == $distributorProduct->product->id)
                                                                checked
                                                                @break
                                                            @endif
                                                        @endforeach
                                                >
                                                <label>{{$distributorProduct->product->product_name}} -
                                                    @if ($distributorProduct->product->product_type == 'Deposit')
                                                        DEPOSITO
                                                    @else
                                                        RETIRO
                                                    @endif
                                                </label>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    </div>
                                <input type="hidden" name="user_id" value="{{$id}}">
                                <input type="submit" class="btn btn-success bg-gradient m-4 float-end" value="Asignar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
