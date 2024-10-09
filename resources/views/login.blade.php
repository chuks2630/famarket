@extends('layout.famarket')

@section('content')
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <h5  class="text-center">SIGN IN</h5>
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" placeholder="Enter email" class="form-control" :value="old('email')">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" placeholder="password" class="form-control"  required autocomplete="current-password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn action_btn col-12">Login</button>
                    </div>
                    <a href="{{route('password.request')}}">Forgot Password ?</a>
                </form>
            </div>
        </div>
    @endsection