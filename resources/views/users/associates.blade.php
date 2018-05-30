@extends('layouts.master') 
@section('title', 'List of Users') 
@section('content')

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
            @if($bool == true)
            <td>
                tomas
            </td>
            @endif
        </tr>
        @endforeach
</table>
@else
<h2>You have no associates.</h2>
@endif
@endsection