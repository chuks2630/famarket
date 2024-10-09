@extends('layout.famarket')

    @section('content')
        <div class="row mt-5 justify-content-center">
            <div class="col-md-4 my-5  p-3" style="background: white;">
                
                <a href="{{route('allcat.show')}}"><i class="fa-solid fa-left-long" style="font-size: 1.5em"></i></a>
                <form method="POST" action="{{ route('subcategories.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="subcategoryName">Subcategory Name:</label>
                        <input type="text" id="subcategoryName" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="categorySelect">Select Category:</label>
                        <select id="categorySelect" name="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn action_btn col-12">Create Subcategory</button>
                </form>
            </div>
        </div>
     @endsection
   
  