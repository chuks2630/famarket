@extends('admin.adminlayout')

@section('resource')
    <h5  class="text-center">SIGN IN</h5>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" placeholder="Enter email" class="form-control" :value="old('email')" required>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mb-3">
            <input type="password" name="password" placeholder="password" class="form-control"  required autocomplete="current-password">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn action_btn col-12">Login</button>
        </div>
    </form>
@endsection