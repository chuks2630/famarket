@extends('layout.famarket')

@section('content')
<div class="row justify-content-around mt-4 gx-1 p-3">
    <div class="col-md-12 user_col px-2">
        <div class="row gx-2 pt-3" style="min-height: 500px">
            <h4 class="text-center">Saved Ads</h4>
            @forelse ($products as $prod)
            <div class="col-md-3 mb-3">
                <div class=" m-2 ad">
                    <a href="{{route('addetail.show',['id'=> $prod->product->id])}}" class="pro_link">
                    <div><img src="/storage/{{$prod->product->filename}}" alt="" class="img-fluid"></div>
                    <div class="p-2">
                        <div class="bookmark" data-value="{{$prod->product->id}}"><i class="fa-regular fa-bookmark"></i></div>
                         <p class="my-1"><b>&#8358; {{number_format($prod->product->price, 2, '.',',')}}</b></p>
                         <p class="my-1" style="font-size: large">{{$prod->product->title}}</p>
                         <p  class="text-muted" style="font-size: small">{{substr($prod->product->description,0,100)}}</p>
                         <p style="font-size: x-small" class="text-muted mb-0"><i class="fa-solid fa-location-dot"></i> {{$prod->product->lga->name.', '.$prod->product->lga->state->name}}</p>
                    </div>
                </a>
               </div>
            </div>
            @empty
            <p style="font-size: large" class="text-muted text-center mt-5">There are no ads to display</p>
        @endforelse
        </div>
    </div>
</div>
@endsection