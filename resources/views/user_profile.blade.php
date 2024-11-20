@extends('layout.userInterface')
     @section('resource')
            <div class="row gx-3">
               <div class="col-md-12 my-2">
                    <h4 class="text-center">My Profile</h4>
                    
               </div>
               <div class="col-md-12">
                    <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                         @method('patch')
                        <div class="row justify-content-center">
                            <div class="col-md-7 mb-3">
                                <label for="firstname">Firstname</label>
                                <input type="text" name="firstname" value="{{old('firstname', $user->firstname)}}" id="firstname" class="form-control">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('firstname')" />
                            </div>
                            <div class="col-md-7 mb-3">
                                <label for="lastname">Lastname</label>
                                <input type="text" name="lastname" value="{{old('lastname', $user->lastname)}}" id="lastname" class="form-control">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('lastname')" />
                            </div>
                            <div class="col-md-7 mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" value="{{old('phone', $user->phone)}}" id="phone" class="form-control">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('phone')" />
                            </div>
                            <div class="col-md-7 mb-3">
                                <label for="profile-pic">Profile Picture</label>
                                <input type="file" name="profile-pic" id="profile-pic" class="form-control" value="{{old('profile-pic')}}">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('profile-pic')" />
                            </div>
                            <div class="col-md-7 mb-3">
                                <button type="submit" class="action_btn col-12">Update</button>
                            </div>
                        </div>
                    </form>
               </div>
            </div>
     @endsection