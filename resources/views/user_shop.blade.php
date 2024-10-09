@extends('layout.famarket')

@section('content')
<div class="row justify-content-around mt-4 gx-1 p-3">
    <div class="col-md-3 user_col p-3 mb-3 pb-4" style="height: 100%">
        <div class="text-center">
            <img src="/assets/img/default.png" alt="" width="80" style="border-radius: 50%;">
            @isset($shop)
                <p>{{$shop->shopname}}</p>
            @endisset
            @empty($shop)
            <p>{{$user->firstname}} {{$user->lastname}}</p>
            @endempty
            <button class="btn btn-success col-12"><i class="fa-solid fa-phone"></i>  {{$user->phone}}</button>
        </div>
    </div>
    <div class="col-md-8 user_col px-2">
        <div class="row gx-2 pt-3" style="min-height: 500px">
            @isset($products)
            @foreach ($products as $prod)
            <div class="col-md-3 mb-3">
                <div class=" m-2 ad">
                    <a href="{{route('addetail.show',['id'=> $prod->id])}}" class="pro_link">
                    <div><img src="/storage/{{$prod->filename}}" alt="" class="img-fluid"></div>
                    <div class="p-2">
                         <p class="my-1"><b>&#8358; {{number_format($prod->price, 2, '.',',')}}</b></p>
                         <p class="my-1" style="font-size: large">{{$prod->title}}</p>
                         <p  class="text-muted" style="font-size: small">{{substr($prod->description,0,100)}}</p>
                         <p style="font-size: x-small" class="text-muted mb-0"><i class="fa-solid fa-location-dot"></i> {{$prod->lga->name.', '.$prod->lga->state->name}}</p>
                    </div>
                </a>
               </div>
            </div>
        @endforeach
        @endisset
        @isset($equipments)
        @foreach ($equipments as $prod)
        <div class="col-md-3 mb-3">
            <div class=" m-2 ad">
                <a href="{{route('eqdetail.show',['id'=> $prod->id])}}" class="pro_link">
                <div><img src="/storage/{{$prod->filename}}" alt="" class="img-fluid"></div>
                <div class="p-2">
                     <p class="my-1"><b>&#8358; {{number_format($prod->price, 2, '.',',')}}</b></p>
                     <p class="my-1" style="font-size: large">{{$prod->title}}</p>
                     <p  class="text-muted" style="font-size: small">{{substr($prod->description,0,100)}}</p>
                     <p style="font-size: x-small" class="text-muted mb-0"><i class="fa-solid fa-location-dot"></i> {{$prod->lga->name.', '.$prod->lga->state->name}}</p>
                </div>
            </a>
           </div>
        </div>
    @endforeach
    @endisset
    @empty($products && $equipments)
        <p style="font-size: large" class="text-muted text-center mt-5">There are no ads to display</p>
    @endempty
        </div>
    </div>
</div>
@endsection