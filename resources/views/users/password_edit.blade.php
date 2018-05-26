@extends('layouts.master')

@section('title', 'Edit Password')

@section('content')

<form action="{{ route('password.update')}}" method="POST" class="form-group">
    @method('patch')
    @csrf
    {{-- {{dd($errors)}} --}}
<div class="form-group row">
     <label for="old-password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
    
     <div class="col-md-6">
        <input id="old-password" type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password" required>
        @if ($errors->has('old_password'))
             <span class="invalid-feedback">
                <strong>{{ $errors->first('old_password') }}</strong>
            </span> 
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="new-password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

    <div class="col-md-6">
        <input id="new-password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

         @if ($errors->has('password'))
            <span class="invalid-feedback">
                 <strong>{{ $errors->first('password') }}</strong>
            </span> 
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success" name="ok">Save</button>
    <a class="btn btn-default" href="{{route('home')}}">Cancel</a>
</div>

</form>

@endSection