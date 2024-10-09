@extends('layout.userInterface')
     @section('resource')
            <div class="row gx-3">
               <div class="col-md-12 my-2">
                    <h4 class="text-center">Company Details</h4>
                   
               </div>
               <div class="col-md-12">
                    <form action=" @isset ($user->shop->id)
                           {{route('businessname.update')}}
                        @endisset
                        @empty($user->shop->id)
                        {{route('businessname.store')}}
                        @endempty" method="POST">
                        @isset ($user->shop->id)
                            @method('patch')
                        @endisset
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-7 mb-3">
                                <input type="text" name="shopname" placeholder="Company name" @isset($user->shop->id)value="{{ $user->shop->shopname}}" @endisset id="storename" class="form-control">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('shopname')" />
                            </div>
                            <div class="col-md-7 mb-3">
                                <input type="text" name="description" placeholder="About Company" value="@isset($user->shop->description){{$user->shop->description}}@endisset" id="description" class="form-control">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('description')" />
                            </div>
                                <input type="hidden" name="id" value="@isset($user->shop->id){{$user->shop->id}}@endisset">
                            <div class="col-md-7 mb-3">
                                <button type="submit" class="action_btn col-12">save</button>
                            </div>
                        </div>
                    </form>
               </div>
            </div>
     @endsection