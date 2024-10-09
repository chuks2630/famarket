@extends('layout.famarket')

    @section('content')
        <div class="row mt-5 justify-content-center">
            <div class="col-md-4 my-5  p-3" style="background: white;">
                
                <a href="{{route('allcat.show')}}"><i class="fa-solid fa-left-long" style="font-size: 1.5em"></i></a>
                <form  action="{{route('addcat.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <h5 class="text-center">Create new Category</h5>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Category Name">
                    </div>
                    <div class=" my-4">
                        <button type="submit" class="btn action_btn col-12" >Create</button>
                    </div>
                </form>
            </div>
        </div>
     @endsection
   
  