@extends('layout.famarket')

@section('content')
        <div class="row my-5">
            <div class="col-md-6">
                <img src="/assets/img/market.jpg" alt="" class="img-fluid">
            </div>

            <div class="col-md-6">
                <h5  class="text-center">Sign Up</h5>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <input type="email" name="email" :value="old('email')" class="form-control" placeholder=" Enter email address">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <input type="text" name="fname"  :value="old('fname')" class="form-control" placeholder=" First name">
                    <x-input-error :messages="$errors->get('fname')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <input type="text" name="lname" :value="old('lname')" class="form-control" placeholder=" Last name">
                    <x-input-error :messages="$errors->get('lname')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <input type="text" name="phone" :value="old('phone')" class="form-control" placeholder=" Phone (digits Only)">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <input type="password" name="password"  class="form-control" placeholder=" Enter Password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirmation" id="" class="form-control" placeholder=" Confirm Password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                
               
                <div class="mb-3">
                    <button type="submit" class="btn  col-12 action_btn"> Submit </button>
                </div>
            </form>
            </div>
        </div>
    @endsection