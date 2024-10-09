@extends('layout.famarket')
        

@section('content')
        <div class="row my-5">
            <div class="col-md-8 offset-md-2 p-2" style="background: white;">
              <form action="{{route('equipmentad.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="row">
                  <h3 class="text-center">Post Ad</h3>
                  <div class="col-md-12 mb-3">
                      <input type="text" name="title" placeholder="Title" class="form-control" value="{{old('title')}}">
                      <x-input-error :messages="$errors->get('title')" class="mt-2 text-danger" />
                  </div>
                  <div class=" col-md-12 mb-3">
                      <textarea class="form-control" name="description" placeholder="Description" value="{{old('description')}}" ></textarea>
                      <x-input-error :messages="$errors->get('description')" class="mt-2 text-danger" />
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="image" class="form-check my-2">Upload Image</label>
                      <input type="file" class="form-control" name="image" id='image' value="{{old('image')}}"> 
                      <x-input-error :messages="$errors->get('image')" class="mt-2 text-danger" />
                      <small class="text-muted">this will be used as the cover image you can upload more images after form submission</small>
                   </div>

                  <div class="col-md-12 mb-3">
                      <label for="category" class=" my-2 px-2 me-1">Category*</label>
                      <select name="category" id="category" class="form-select" value="{{old('category')}}">
                        <option value="">Please select</option>
                        @foreach($subcats as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                      </select>
                      <x-input-error :messages="$errors->get('category')" class="mt-2 text-danger" />
                    </div>

                  <div class="col-md-6 mb-3 ">
                     <input type="number" placeholder="Price*" class="form-control" name="price" value="{{old('price')}}"> 
                     <x-input-error :messages="$errors->get('price')" class="mt-2 text-danger" />
                  </div>
                  <div class="col-md-6 mb-3 ">
                      <input type="number" placeholder="Quantity*" class="form-control" name="quantity" value="{{old('quantity')}}"> 
                      <x-input-error :messages="$errors->get('quantity')" class="mt-2 text-danger" />
                   </div>


                        <div class="row mt-3" id="machinery">
                        <div class="col-md-6 mb-3">
                            <label for="condition" class="mb-2">Condition</label>
                            <select name="condition" id="condition" class="form-select">
                               <option value="1">Brand New</option>
                                <option value="2">Used</option>
                                <option value="3">for parts/not working</option>
                            </select>
                            <x-input-error :messages="$errors->get('condition')" class="mt-2 text-danger" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="biztype" class="mb-2">Business type</label>
                            <select name="biztype" id="biztype" class="form-select">
                                <option value="1">Sale</option>
                                <option value="2">Rent</option>
                                <option value="3">Lease</option>
                                
                            </select>
                            <x-input-error :messages="$errors->get('biztype')" class="mt-2 text-danger" />
                        </div>
                    </div>

                    <small class="text-muted mt-4 mb-2">Location*</small>
                    <div class="col-md-12 mb-3 ">
                        <label for="state" class="my-2  px-2 me-1">Lga</label>
                        
                            <select name="lga" id="state" class="form-select" value="{{old('lga')}}">
                              <option value="">Please select</option>
                              @foreach($lgas as $lga)
                              <option value="{{$lga->id}}">{{$lga->name}}</option>
                              @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('lga')" class="mt-2 text-danger" />
                        </div>
                    <div class="col my-4">
                        <button class="btn action_btn col-12">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
  @endsection
