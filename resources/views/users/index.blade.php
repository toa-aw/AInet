@extends('layouts.master') 
@section('title', 'List of Users') 
@section('content')



<form action="{{ route('users') }}">
    @csrf
    <div class="form-group row">
        <label for="name">{{__('Name:')}}</label>
        <input type="search" id="name" name="name" value="{{old('name') ?? null}}"> @if ($errors->has('name'))
        <span class="invalid-feedback">
             <strong>{{ $errors->first('name') }}</strong>
        </span> @endif
    </div>
    <div class="form-group row">
        <label for="type_admin">{{__('Admin')}}</label>
        <input type="radio" id="type_admin" name="type" value="admin">

        <label for="type_user">{{__('User')}}</label>
        <input type="radio" id="type_user" name="type" value="normal"> @if ($errors->has('admin'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('admin') }}</strong>
        </span> @endif
    </div>

    <div class="form-group row">
        <label for="status_open">{{__('Open')}}</label>
        <input type="radio" id="status_open" name="status" value="unblocked">

        <label for="status_blocked">{{__('Blocked')}}</label>
        <input type="radio" id="status_blocked" name="status" value="blocked"> @if ($errors->has('status'))
        <span class="invalid-feedback">
             <strong>{{ $errors->first('status') }}</strong>
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

            <td
                @if($user->blocked)) class="user-is-blocked" @endif>
                {{ $user->blockToStr() }}

            </td>

            <td @if($user->admin)) class="user-is-admin" @endif>     
                 {{ $user->adminToStr() }}
            </td>
            <td>
                <form action="{{route('users.block', $user->id)}}" method="POST">
                    @method('patch')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger" > Block</button>
                </form>

                <form action="{{route('users.unblock', $user->id)}}" method="POST">
                    @method('patch')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-primary" > Unblock </button>
                </form>
            </td>

            <td>
                
                <form action="{{route('users.demote', $user->id)}}" method="POST">
                        @method('patch')
                        @csrf
                        <button type="submit" class="btn btn-xs btn-danger" > Demote</button>
                 </form>

                <form action="{{route('users.promote', $user->id)}}" method="POST">
                        @method('patch')
                        @csrf
                        <button type="submit" class="btn btn-xs btn-primary" > Promote</button>
                </form>
                    
                </td>
            </tr>
        @endforeach
</table>
@else
<h2>No users found</h2>
@endif
@endsection