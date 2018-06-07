@extends('layouts.master') 
@section('title', 'Add Document to Movement') 
@section('content') 

<form action="{{route('movement.associateDocument', $id)}}" method="post" class="form-group" enctype="multipart/form-data">
    @csrf
    <div class="form-group row">
        <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Mevement File') }}</label>
        <div class="col-md-6">
            <input id="file" type="file" name="document_file" autofocus> 
            @if ($errors->has('document_file'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('document_file') }}</strong>
                </span>@endif
        </div>
    </div>
    
    <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
        <div class="col-md-6">
            <input id="description" type="text" class="form-control{{ $errors->has('document_description') ? ' is-invalid' : '' }}" name="document_description" value="{{ old('document_description') }}" autofocus>
            @if ($errors->has('document_description'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('document_description') }}</strong>
                </span> 
            @endif
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Associate</button>
        <a class="btn btn-default" href="{{route('home')}}">Cancel</a>
    </div>
</form>
@endsection