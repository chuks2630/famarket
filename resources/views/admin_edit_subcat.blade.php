@extends('layout.famarket')

    @section('content')
        <div class="row mt-5 justify-content-center">
            <div class="col-md-4 my-5  p-3" style="background: white;">
                
                <a href="{{route('allcat.show')}}"><i class="fa-solid fa-left-long" style="font-size: 1.5em"></i></a>
                <form method="POST" action="{{ route('subcategories.update', $subcategory->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="subcategoryName">Subcategory Name:</label>
                        <input type="text" id="subcategoryName" name="name" class="form-control" value="{{ $subcategory->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="categorySelect">Select Category:</label>
                        <select id="categorySelect" name="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($subcategory->category_id == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn action_btn col-12 mb-3">Update Subcategory</button>
                </form>

                <form action="{{route('subcategories.delete', $subcategory->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class=" btn btn-outline-danger">Delete Subcategory</button>
                </form>
            </div>
        </div>
     @endsection
   
  