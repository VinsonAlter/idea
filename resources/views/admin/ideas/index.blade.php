@extends('layout.layout')

@section('title', 'Ideas | Admin Dashboard')

@section('container')
    <div class="row">
        <div class="col-3">
          @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            <h1>Ideas</h1>

            <table class="table table-striped mt-3"> 
                <thead class="table-dark"> 
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined At</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ideas as $idea)
                        <tr>
                            {{-- <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->toDateString()}}</td>
                            <td>
                                <a href="{{route('users.show', $user)}}">View</a>
                                <a href="{{route('users.edit', $user)}}">Edit</a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{$ideas->links()}}
            </div>
        </div>
    </div>
@endsection