@extends('layouts.master') 
@section('title', 'List of Users') 
@section('content')

<div>  
    <a class="btn btn-primary" href="{{route('user.add.associate')}}">Add Associate</a>
</div>
@if (count($users))
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            @if($bool == true)
            <th>Link</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                {{ $user->name }}
            </td>

            <td>
                {{ $user->email }}
            </td>
            <td>                          
                <form action="{{route('user.delete.associate', $user->id)}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                </form>        
            </td>
            @if($bool == true)
            <td>
                <a href="{{route('user.accounts', $user->id)}}"> Accounts </a>
            </td>
            @endif
        </tr>
        @endforeach
</table>
@else
<h2>You have no associates.</h2>
@endif
@endsection