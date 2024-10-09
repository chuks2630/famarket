@extends('layout.famarket')

    @section('content')
        <div class="row mt-5 justify-content-center">
            <div class="col-md-4 my-5  p-3" style="background: white;">
               
                <form action="{{route('postad.form')}}" method="POST">
                    @csrf
                    <h5 class="text-center">What type of Ad do you Want to Post?</h5>
                    <div class="mb-3">
                        <select name="category" id="" class="form-select">
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="state" id="" class="form-select">
                            <option value="">Please select state</option>
                            @foreach($states as $state)
                              <option value="{{$state->id}}">{{$state->name}}</option>
                              @endforeach
                        </select>
                    </div>
                    <div class=" my-4">
                        <button class="btn action_btn col-12">Next</button>
                    </div>
                </form>
            </div>
        </div>
     @endsection
   
  