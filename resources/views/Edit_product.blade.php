@extends('layout.famarket')
        

@section('content')
        <div class="row my-5">
            <div class="col-md-8 offset-md-2 p-2" style="background: white;">
                <form action="{{route('editproduct',["id"=>$product->id])}}" method="POST" enctype="multipart/form-data">
                    @method("patch")
                  @csrf
                    <div class="row">
                    <h3 class="text-center">Post Ad</h3>
                    <div class="col-md-12 mb-3">
                        <input type="text" name="title" placeholder="Title" class="form-control" value="{{$product->title}}">
                        <x-input-error :messages="$errors->get('title')" class="mt-2 text-danger" />
                    </div>
                    <div class=" col-md-12 mb-3">
                        <textarea class="form-control" name="description" placeholder="Description" value="{{old('description')}}" > {{$product->description}}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2 text-danger" />
                    </div>
                    <div class="col-md-12 mb-3">
                      <label for="image" class="form-check my-2">Change Cover Image</label>
                        <input type="file" class="form-control" name="image" id='image' value="{{old('image')}}"> 
                        <x-input-error :messages="$errors->get('image')" class="mt-2 text-danger" />
                        <small class="text-muted">this will be used as the cover image you can upload more images after form submission</small>
                     </div>
                     <div class="col-md-12 mb-3">
                        <label for="category" class=" my-2 px-2 me-1">Category*</label>
                        <select name="category" id="category" class="form-select" value="{{old('category')}}">
                          <option value="">Please select</option>
                          @foreach($cats as $cat)
                          <option value="{{$cat->id}}"@if ($cat->id == $product->subcat_id)
                              selected
                            @endif>{{$cat->name}}</option>
                          @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2 text-danger" />
                      </div>
                    <div class="col-md-6 mb-3 ">
                       <input type="number" placeholder="Price*" class="form-control" name="price" value="{{$product->price}}"> 
                       <x-input-error :messages="$errors->get('price')" class="mt-2 text-danger" />
                    </div>
                    <div class="col-md-6 mb-3 ">
                        <input type="number" placeholder="Quantity*" class="form-control" name="quantity" value="{{$product->quantity}}"> 
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2 text-danger" />
                     </div>

                    <div class="col my-4">
                        <button type="submit" class="btn action_btn col-12">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
  @endsection
   
   