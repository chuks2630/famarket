@if($products->isNotEmpty())
    <ul style="background: white; list-style: none">
        @foreach($products as $product)
            <li><a href="{{route('addetail.show', $product->id)}}" class="pro_link">{{ $product->title }} in {{ $product->subcategory->name }}</a></li>
        @endforeach
    </ul>
@else
    <p>No products found matching your search.</p>
@endif