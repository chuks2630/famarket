@extends('admin.adminDashboard')

@section('resource')
<div class="p-3">
    <p>Welcome to the Admin dashboard </p>
    <span>Use the side panel to perform tasks!</span>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="btn sm_btn my-3">Logout</button>
    </form>
</div>
    
@endsection

