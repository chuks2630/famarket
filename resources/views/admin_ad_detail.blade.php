@extends('layout.famarket')

@section('content')


<div class="row my-5 justify-content-around">
    <div class="col-md-8 catmenu p-2" style="height: 100%">
        <div class="row">
            <div class="col">
                <img src="/storage/{{$product->filename}}" alt="" class="img-fluid">
            </div>
        </div>
        @isset($product->product_images)
        <div class="row mt-3">
            @foreach($product->product_images as $image)
            <div class="col-md-3">
                <img src="/storage/{{$image->filename}}" alt="" class="img-fluid">
            </div>
            @endforeach
        </div>
        @endisset
        <div class="row p-3">
            <div class="col-md-12">
                <h3>{{$product->title}}</h3>
                <p class="my-0 text-muted" style="font-size: 12px"><i class="fa-solid fa-location-dot"></i> {{$product->lga->name.', '.$state->name}}</p>
                <div class="my-3">
                    <p>{{$product->description}} </p>
                    <p style="font-size: large; font-weight:500" class="mb-1">Quantity</p>
                    <small class="mt-1"> {{$product->quantity}}</small>
                </div>
                @isset($product->condition)
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        <p style="font-size: large; font-weight:500" class="mb-1">Business Type</p>
                        <small>@if($product->businesstype == 1)Sale @elseif($product->businesstype == 2)Rent @else Lease @endif</small>
                    </div>
                    <div class="col-md-3">
                        <p style="font-size: large; font-weight:500" class="mb-1">Condition</p>
                        <small class="mt-1">@if($product->condition == 1)Brand New @elseif($product->condition == 2)Used @else For parts/not working @endif</small>
                    </div>
                </div>
            @endisset
            </div>
            @isset($shop->shop_adds)
            <div class="col-md-12 my-4">
                @foreach($shop->shop_adds as $add)
                <div class="text-muted">
                <p class="my-0"><i class="fa-solid fa-shop"></i>  {{$add->storename}}</p>
                <p>{{$add->address}}</p>
                </div>
                @endforeach
            </div>
            @endisset
        </div>
    </div>
    <div class="col-md-3 catmenu p-2" style="height: 100%">
        <div class="p-2">
            <h4>&#8358;  {{number_format($product->price, 2, '.',',')}}</h4>
            @isset($product->bulk_sizes)
            @foreach($product->bulk_sizes as $bulk)
            <small>from {{$bulk->size}} &#8358; {{number_format($bulk->price, 2, '.',',')}}</small>
            @endforeach
            @endisset
        </div>
        <div class="row py-3 gx-0 my-3">
            <small class="text-center text-muted mb-3">Seller</small>
            <div class="col-4 ps-2">
                <img src="/assets/img/default.png" alt="" style="width:70%; border-radius: 100%">
            </div>
            <div class="col-7 p-2">
                @isset($shop->shopname)
                <p class="text-center">{{$shop->shopname}}</p>
                @endisset

                @empty($shop->shopname)
                <p class="text-center">{{$user->firstname.' '.$user->lastname}}</p>
                @endempty
            </div>
            <div class="col-md-12 my-3">
                <button class="btn btn-success col-12"><i class="fa-solid fa-phone"></i>  {{$user->phone}}</button>
            </div>
        </div>
        <div class="mt-5 px-2 py-2">
            <form action="@isset($product->condition) {{route('eq.alter',['id'=> $product->id])}} @endisset @empty($product->condition){{route('ad.alter',['id'=> $product->id])}} @endempty" method="POST">
                @method('patch')
                @csrf
                <div class="row justify-content-center m-2 p-2" style="border: 1px solid green">
                <div class="col-4 mb-3">
                    <label for="yes"><i class="fa-solid fa-circle-check text-success" ></i> Approve</label>
                    <input type="radio" name="approval" id="yes" value="1" checked>
                </div>
                <div class="col-4 mb-3">
                    <label for="no"><i class="fa-regular fa-circle-xmark text-danger"></i> Decline</label>
                    <input type="radio" name="approval" id="no" value="2">
                </div>
                <div>
                    <button type="submit" class="btn sm_btn col-12">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection