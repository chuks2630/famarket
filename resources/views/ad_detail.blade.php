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
                <img src="/storage/{{$user->profile_pic}}" alt="" style="width:70%; border-radius: 100%">
            </div>
            <div class="col-7 p-2">
                @isset($shop->shopname)
                <p class="text-center"><a href="{{route('shop', $user->id)}}" class="shop_link">{{$shop->shopname}}</a></p>
                @endisset

                @empty($shop->shopname)
                <p class="text-center"><a href="{{route('shop', $user->id)}}" class="shop_link">{{$user->firstname.' '.$user->lastname}}</a></p>
                @endempty
            </div>
            <div class="col-md-12 my-2">
                <button class="btn btn-success col-12"><i class="fa-solid fa-phone"></i>  {{$user->phone}}</button>
            </div>
            <div class="col-md-12 mt-1">  
                <div class=" d-none" id="convo">
                    <button type="button" class="btn-close mb-2" aria-label="Close" id="closebtn"></button>
                    <form action="" id="start-conversation">
                        <input type="hidden" id="participant" value="{{$user->id}}">
                        <input type="text" name="message" class="form-control" placeholder="Type Message" id="start-message">
                        <button type="submit" id="subbtn" class="btn btn-warning col-12 mt-2" disabled>Start Chat</button>
                    </form>
                </div>
                <div id="start-chat">
                <button class="btn btn-outline-success col-12"  id="conversation"><i class="fa-regular fa-message"></i> Start Chat</button>
                </div>
            </div>
        </div>
        <div>
            <a href="@isset($product->condition) {{route('review.show', ['id'=> $product->id])}} @endisset @empty($product->condition) {{route('comment.show', ['id'=> $product->id])}} @endempty" class="btn btn-outline-warning col-12">Feedback <i class="fa-regular fa-comment-dots"></i></a>
        </div>
        <div class="mt-5 px-2 py-2">
            <h5  class="text-center">Safety tips</h5>
            <ul>
                <li>Avoid paying in advance, even for delivery</li>
                <li>Meet with the seller at a safe public place</li>
                <li>Inspect the item and ensure it's exactly what you want</li>
                <li>Make sure that the packed item is the one you've inspected</li>
                <li>Only pay if you're satisfied</li>
            </ul>
        </div>
    </div>
</div>

@endsection