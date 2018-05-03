@extends('layouts.master')
@section('title', 'List of Users')

@section('content')


<form action="">
    @csrf
    <label for="name">{{__('Name')}}</label>
    <input type="text" id="name" name="name" value="{{old('name')}}">

</form>

@if (count($users))
<table class="table table-striped">
    <thead>
        <tr>
            <th>Email</th>
            <th>Fullname</th>   
            <th>Status</th>
            <th>Account Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->blockToStr() }}</td>
            <td>{{ $user->adminToStr() }}</td>

            {{-- <td>
                <!-- TODO: Adaptar -->
                <a class="btn btn-xs btn-primary" href="{{route('users.edit', $user->id)}}">Edit</a>
                <form action="{{route('users.destroy', $user)}}" method="POST" role="form" class="inline">
                    @method('delete') @csrf
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                </form>

            </td> --}}
        </tr>
        @endforeach
</table>
@else
<h2>No users found</h2>
@endif
@endsection