@extends('layouts.master')

@section('title', 'Create Movement')

@section('content')
@if($errors->any())
    @include('partials.errors')
@endif
<form action="{{route('movements.store', $account->id)}}" method="post" class="form-group">
    @include('movements.partials.add-edit')
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Create</button>
        <a class="btn btn-default" href="{{route('home')}}">Cancel</a>
    </div>
</form>
@endsection
