@extends('layout.famarket')

@section('content')
<div class="row mb-4  gx-0  p-3 px-0 ">
    <div class="col-md-8 offset-md-4">
        <form action="#">
        <div class="row d-flex gx-0">
            <div class="col-md-6">
                <input type="text" id="search_cat" name="query" placeholder="What do you need?" class="form-control search_input">
            </div>
            <div class="col-md-2">
                <button type="submit" class="site-btn">SEARCH</button>
            </div>
        
        </div>
        </form>
        <div id="search-result" class="col-md-6 mt-2"></div>
    </div>

</div>

<!--intro/nav end-->

<div class="row mb-4 justify-content-around">
<div class="col-md-3 catmenu px-0">
    <div class="cat_header "><p><i class="fa-solid fa-layer-group"></i> Categories</p></div>
    <div class="row  p-2 pt-0">
        <div class="col-md-12">
            <ul class="dropmenu  ps-0">
                @foreach($subcategories as $category)
                    <li class="cat_link"><a href="/category/{{$category->id}}" >{{$category->name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-12">
            <form action="" id="priceRange">
                <div class="row my-3 p-2">
                    <small class="text-muted mb-2">Price Range</small>
                    <div class="col-md-5">
                        <input type="number" placeholder="Min" id="minPrice" class="form-control">
                    </div>
                    <div class="col-md-1 "><b>_</b></div>
                    <div class="col-md-5">
                        <input type="number" placeholder="Max" id="maxPrice" class="form-control">
                    </div>
                    <div class="my-3"><button type="submit" class="btn btn-success btn-sm">Apply</button></div>
                </div>
                
            </form>
        </div>
    </div>
</div>
<div class="col-md-8 catmenu p-2">
    <div class="row" id="productContainer">
        @forelse ($products as $prod)
        <input type="hidden" id="category_id" value="{{$prod->subcat_id}}">
        <div class="col-md-4">
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
        @empty
        <p style="font-size: large" class="text-muted text-center mt-5">There are no ads to display</p>
    @endforelse
    
    </div>
</div>
</div>

@endsection

