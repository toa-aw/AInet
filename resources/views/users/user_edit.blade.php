@extends('layouts.master')

@section('title', 'Edit User')

@section('content')
{{-- {{dd($user->id)}} --}}
<form action="{{ route('user.update', $user) }}" method="post">
@method('put')
@csrf

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $user->name) }}" required autofocus>
        @if ($errors->has('name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
         @endif       
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user->email) }}" required> 
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span> 
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

    <div class="col-md-6">
        <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone',$user->phone) }}" autofocus>
        @if ($errors->has('phone'))
             <span class="invalid-feedback">
              <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Profile Photo') }}</label>

    <div class="col-md-6">
        <input id="photo" type="file" name="profile_photo" autofocus>
         @if ($errors->has('profile_photo'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('profile_photo') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-success" name="ok">Save</button>
    <a class="btn btn-default" href="{{route('home')}}">Cancel</a>
</div>

</form>
@endsection