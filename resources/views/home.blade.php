@extends('layouts.master') 
@section('title', 'Home Page') 
@section('content')

<div>
    <h2>Welcome!</h2>
    <p>Number of Users: {{ $users}}</p>
    <p>Number of Movements: {{ $movements}}</p>
    <p>Number of Accounts: {{ $accounts}}</p>
</div>  
@endsection