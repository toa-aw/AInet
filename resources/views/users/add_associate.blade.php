@extends('layouts.master')

@section('title', 'Add Associate')

@section('content')
@if($errors->any())
    @include('partials.errors')
@endif
<form action="{{route('user.store.associate')}}" method="post" class="form-group">
    @csrf
    <div class="form-group">
    <label for="inputAssociate">{{ __('Associate') }}</label>
    <input
        type="text" class="form-control" 
        name="associated_user" id="inputAssociate" 
        placeholder="Associate Name" /> 
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Create</button>
        <a class="btn btn-default" href="{{route('home')}}">Cancel</a>
    </div>
</form>
@endsection
