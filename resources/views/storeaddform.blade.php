@extends('layout.userInterface')
     @section('resource')
            <div class="row gx-3">
               <div class="col-md-12 mt-4">
                    
               </div>
               <div class="col-md-12">
                  <form action="{{route('address.store')}}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-7 my-3">
                            <input type="text" name="storename" placeholder="Storename" value="Store 1" class="form-control">
                        </div>

                        <div class="col-md-7 mb-3">
                            <label for="state" class="mb-2 text-muted ps-2" >State</label>
                            <Select name="state" class="form-select" id="stateid">
                                <option value="">Select state</option>
                                @foreach ($states as $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                @endforeach
                               
                            </Select>
                        </div>

                        <div class="col-md-7 mb-3">
                            <label for="lga" class="mb-2 text-muted ps-2" >Lga</label>
                            <Select name="lga" class="form-select" id="lga">
                                <option value="">Select lga</option>
                            </Select>
                        </div>

                        <div class="col-md-7 mb-3">
                            <input type="text" name="address" placeholder="Address" class="form-control">
                        </div>

                        <div class="col-md-7 mb-3">
                            <input type="submit"   class="btn action_btn col-12">
                        </div>
                    </div>
                  </form>
               </div>
            </div>
     @endsection