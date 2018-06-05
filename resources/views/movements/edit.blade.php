@extends('layouts.master')

@section('title', 'Edit Movement')

@section('content')
@if ($errors->any())
    @include('partials.errors')
@endif
<form action="{{route('movements.update', $movement->id)}}" method="post" class="form-group">
    @method('put')
    @include('movements.partials.add-edit')
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        <a class="btn btn-default" href="{{route('movements', $movement->account_id)}}">Cancel</a>
    </div>
</form>
@endsection
