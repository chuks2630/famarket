@extends('layout.userInterface')
     @section('resource')
            <div class="row gx-3">
               <div class="col-md-12 mt-4">
                    <h5 class="text-center">Add store address</h5>
                    
               </div>
               <div class="col-md-12 text-center mt-5">
                   <a href="{{route('storeaddress')}}" class="btn action_btn"><i class="fa-solid fa-plus"></i> Add Store</a>
               </div>
            </div>
     @endsection