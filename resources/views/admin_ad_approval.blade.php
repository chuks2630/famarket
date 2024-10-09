@extends('layout.adminDashboard');

@section('resource')
    <div class="row justify-content-end">
        <div class="col-md-3 p-3 text-center">
            <div class="rectangle p-2 pb-1">
                <small>Total number of Ads</small>
                <p>@isset($total) {{$total}} @endisset</p>
            </div>
        </div>
    </div>
    <div class="row p-2 gx-2">
        <div class="col-md-12 mb-3">
            <p class="text-center" style="font-size: large; font-weight:500">Ads Pending Approval</p>
           
        </div>
        @isset($ads)
        @foreach ($ads as $ad)
         <div class="col-md-3">
            <a href="{{route('approve.detail', ['id'=> $ad])}}" style="text-decoration: none; color:black;">
              <div class=" m-2 ad">
                   <div><img src="/storage/{{$ad->filename}}" alt="" class="img-fluid"></div>
                   <div class="p-2">
                        <p class="my-1"><b>&#8358; {{number_format($ad->price, 2, '.',',')}}</b></p>
                        <p class="my-1" style="font-size: large">{{$ad->title}}</p>
                        <p  class="text-muted" style="font-size: small">{{substr($ad->description,0,100)}}</p>
                        <p style="font-size: x-small" class="text-muted mb-0"><i class="fa-solid fa-location-dot"></i> {{$ad->lga->name}}</p>
                   </div>
              </div>
            </a>
         </div>
        @endforeach
    @endisset
    
    @isset($eqads)
    @foreach ($eqads as $ad)
     <div class="col-md-3">
        <a href="{{route('eq.detail',['id'=> $ad->id])}}" style="text-decoration: none; color:black;">
          <div class=" m-2 ad">
               <div><img src="/storage/{{$ad->filename}}" alt="" class="img-fluid"></div>
               <div class="p-2">
                    <p class="my-1"><b>&#8358; {{number_format($ad->price, 2, '.',',')}}</b></p>
                    <p class="my-1" style="font-size: large">{{$ad->title}}</p>
                    <p  class="text-muted" style="font-size: small">{{substr($ad->description,0,100)}}</p>
                    <p style="font-size: x-small" class="text-muted mb-0"><i class="fa-solid fa-location-dot"></i> {{$ad->lga->name}}</p>
               </div>
          </div>
        </a>
     </div>
    @endforeach
    @endisset
    </div>
@endsection