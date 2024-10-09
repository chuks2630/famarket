@extends('layout.famarket')

    @section('content')
        <div class="row mt-5 justify-content-center">
            <div class="col-md-4 my-5  p-3" style="background: white;">
                
                <a href="{{route('allcat.show')}}"><i class="fa-solid fa-left-long" style="font-size: 1.5em"></i></a>
                <form method="POST" action="{{ route('cat.update', $category->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="categoryEditName">Category Name:</label>
                        <input type="text" id="categoryEditName" name="name" class="form-control" value="{{ $category->name }}" required>
                    </div>

                    <button type="submit" class="btn action_btn col-12 mb-3">Update Category</button>
                </form>

                <form action="{{route('cat.delete', $category->id)}}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class=" btn btn-outline-danger">Delete Category</button>
                </form>
            </div>
        </div>
     @endsection
   
  