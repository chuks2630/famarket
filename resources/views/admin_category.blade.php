@extends('layout.adminDashboard')

@section('resource')
    <div class="row p-2 justify-content-end mt-2">
        <div class="col-md-4 text-center">
            <a href="{{route('addcat.show')}}" class="sm_btn btn mb-3">Add category</a>
            <a href="{{route('addsubcat.show')}}" class="sm_btn btn">Add subcategory</a>
        </div>
        <div class="col-md-12">
            
            <h5 class="text-center">All Categories</h5>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Category</th>
                        <th>Sub-category</th>
                    </tr>
                    <tbody>
                        <?php $k=1?>
                       @foreach ($cats as $cat)
                           <tr>
                            <td>{{$k++}}</td>
                            <td><a href="{{route('cat.edit', $cat->id)}}" style="color: green">{{$cat->name}}</a></td>
                            <td>
                                @foreach($cat->subcategories as $subcat)
                                    <p><a href="{{route('subupdate', $subcat->id)}}" style="color: green">{{$subcat->name}}</a></p>
                                 @endforeach
                            </td>
                           </tr>
                       @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection