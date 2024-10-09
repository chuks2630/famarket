@extends('layout.adminDashboard')

@section('resource')
    <div class="row p-2 justify-content-end mt-2">
        <div class="col-md-4 text-center">
            
            <form action="{{route('update.user')}}" method="POST">
                @method('patch')
                @csrf
                <label for="email" style="font-weight: 500">Change User Status</label>
                <div class="mb-3 mt-2">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter user E-mail">
                </div>
                <div>
                    <button type="submit" class="btn  sm_btn col-12">Send</button>
                </div>
                
            </form>
        </div>
        <div class="col-md-12">
            <p class="text-center" style="font-weight: 500">All Users: {{$count}}</p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>First name</th>
                        <th>Lastname</th>
                        <th>Phone</th>
                        <th>E-mail</th>
                        <th>Date Registered</th>
                        <th>status</th>
                    </tr>
                    <tbody>
                        <?php $k = 1; ?>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$k++}}</td>
                                <td>{{$user->firstname}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>{{$user->status}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection