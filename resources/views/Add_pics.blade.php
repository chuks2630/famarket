@extends('layout.famarket')

    @section('content')
        <div class="row mt-5 justify-content-center">
            <div class="col-md-4 my-5  p-3" style="background: white;">
               
                <a href="{{route('myads')}}"><i class="fa-solid fa-left-long" style="font-size: 1.5em"></i></a>
                <form  action="{{ route('imageupload',$id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <h5 class="text-center">Add picture</h5>
                    <div class="mb-3">
                        <input type="file" name="imageup" id="imageup" class="form-control">
                        <input type="hidden" value="{{$id}}" id="id">
                    </div>
                    <div class=" my-4">
                        <button type="submit" class="btn action_btn col-12" id="uploadImage">Upload Image</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center my-4">
            <div class="col-5">
                <div id="imagePreview">
                    <img src="{{session('image')}}" alt="">
                </div>
            </div>
        </div>
     @endsection
   
  