@extends('layouts.master') 
@section('title', 'List of Profiles') 
@section('content')

<form action="{{ route('profiles') }}">

    <div class="form-group row">
        <label for="name">{{__('Name:')}}</label>
        <input type="search" id="name" name="name" value="{{old('name') ?? null}}"> @if ($errors->has('name'))
        <span class="invalid-feedback">
             <strong>{{ $errors->first('name') }}</strong>
        </span> @endif
    </div>

    <div class="form-group row mb-0">
        <div>
            <button type="submit" class="btn btn-primary"> {{__('Search')}}</button>
        </div>
    </div>
</form>

@if (count($users))
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Profile Photo</th>
            <th>Group</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                {{ $user->name }}
            </td>
            
            <td>
                @if($user->profile_photo)
                <img src = {{asset('storage/profiles/'.$user->profile_photo)}} /> 
                @endif
            </td>

            <td>
                @if($user->isAssociate(Auth::id()))
                    <span>associate-of</span>
                @endif
                @if($user->isAssociateOf(Auth::id()))
                    <span>associate</span>
                @endif
            </td>
            
        </tr>
        @endforeach
</table>
@else
<h2>No users found</h2>
@endif
@endsection