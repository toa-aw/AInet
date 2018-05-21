@extends('layouts.master')

@section('title', 'Edit Account')

@section('content')
@if ($errors->any())
    @include('partials.errors')
@endif
<form action="{{route('accounts.update', $account->id)}}" method="post" class="form-group">
    @method('put')
    @include('accounts.partials.add-edit')
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        <a class="btn btn-default" href="{{route('home')}}">Cancel</a>
    </div>
</form>
@endsection
