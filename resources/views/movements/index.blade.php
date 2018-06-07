@extends('layouts.master') 
@section('title', 'Account Movements') 
@section('content')

<div>  
    <a class="btn btn-primary" href="{{route('movements.create', $account->id)}}">Add Movement</a>
</div>

@if (count($movements))
<table class="table table-striped">
    <thead>
        <tr>
            <th>Category</th>
            <th>Date</th>
            <th>Value</th>
            <th>Type</th>
            <th>End Balance</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movements as $movement)
        <tr>
            <td> {{ $movement->getCategoryName($movement->movement_categories) }} </td>
            <td> {{ $movement->date }} </td>
            <td> {{ $movement->value }} </td>
            <td> {{ $movement->type }} </td>
            <td> {{ $movement->end_balance }} </td>
            <td>
                <a class="btn btn-xs btn-primary" href="{{route('movements.edit', $movement->id)}}">Edit</a>
                                
                <form action="{{route('movements.delete', $movement->id)}}" method="POST" role="form" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                </form>        
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<h2>No movements found</h2>
@endif
@endsection