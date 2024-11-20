@extends('layout.famarket')

@section('content')
<div class="row mt-3 ps-3">
    <div class="col-md-5">
        <div class="d-flex">
        <div style="height: 100%"><img src="/assets/img/female-farmer-black.svg" alt="icon"></div><div class="speech-bubble p-2 ms-2"><span id="intro-text"> Welcome to Famarket!  </span></div>
    </div>
    </div>
</div>
<div class="row mb-4  gx-0  p-3 px-0 ">
    <div class="col-md-8 offset-md-4">
        <form action="#">
        <div class="row d-flex gx-0">
            <div class="col-md-6 m-1">
                <input type="text" id="search" name="query" placeholder="What do you need?" class="form-control search_input">
            </div>
            <div class="col-md-2 m-1">
                <button type="submit" class="site-btn">SEARCH</button>
            </div>
        
        </div>
        </form>

        <div id="search-results" class="col-md-6 mt-2"></div>
    </div>

</div>

<!--intro/nav end-->

<div class="row mb-4 justify-content-around">
<div class="col-md-3 catmenu px-0" style="height: 100%">
    <div class="cat_header "><p><i class="fa-solid fa-layer-group"></i> Categories</p></div>
    <div class="row p-2">
        <div class="col-md-12">
            <ul class="dropmenu ps-0">
                @foreach ($categories as $cat)
                <li class="dropdown dropend">
                    <a href="" data-mdb-button-init
                    data-mdb-ripple-init data-mdb-dropdown-init class=" dropdown-toggle"
                    id="dropdownMenuButton"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false">{{$cat->name}}</a>
                    
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($cat->subcategories as $subcat)
                          <li><a class="dropdown-item" href="/category/{{$subcat->id}}">{{$subcat->name}}</a></li>
                          @endforeach
                        </ul>
                     
                </li>
                @endforeach
                
            </ul>
        </div>
    </div>
</div>
<div class="col-md-8 catmenu p-2">
    <div class="row">
        @foreach ($products as $prod)
        <div class="col-md-3">
            <div class=" m-2 ad">
                <a href="@isset($prod->condition){{route('eqdetail.show',['id'=> $prod->id])}}@endisset @empty($prod->condition){{route('addetail.show',['id'=> $prod->id])}}@endempty" class="pro_link">
                <div><img src="/storage/{{$prod->filename}}" alt="" class="img-fluid"></div>
                <div class="p-2">
                    <div class="bookmark" data-value="{{$prod->id}}"><i class="fa-regular fa-bookmark"></i></div>
                     <p class="my-1"><b>&#8358; {{number_format($prod->price, 2, '.',',')}}</b></p>
                     <p class="my-1" style="font-size: large">{{$prod->title}}</p>
                     <p  class="text-muted" style="font-size: small">{{substr($prod->description,0,100)}}</p>
                     <p style="font-size: x-small" class="text-muted mb-0"><i class="fa-solid fa-location-dot"></i> {{$prod->lga->name.', '.$prod->lga->state->name}}</p>
                </div>
            </a>
           </div>
        </div>
    @endforeach
    </div>
</div>
</div>

@endsection