@extends('layouts.master')
@section('title', 'Users Account List')

@section('content')
   @if (count($accounts))
<table class="table table-striped">
    <thead>
        <tr>
            <th>Code</th>
            <th>Type</th>
            <th>Current Balance</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accounts as $account)
        <tr>
            <td>
                {{ $account->code }}
            </td>

            <td>
                {{ $account->accountTypeToStr() }}
            </td>
            <td>
                {{ $account->current_balance }}
            </td>

            <td>
            @if(!$account->isOpen())
                <form action="{{ route('accounts.reopen', $account->id) }}" method="POST">
                    @method('patch') 
                    @csrf
                    <button type="submit" class="btn btn-xs btn-primary"> Open </button>
                </form>
            @else
                @if(!$account->hasMovements())
                    <form action="{{ route('accounts.delete', $account->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-xs btn-danger"> Delete </button>
                    </form>
                @elseif($account->hasMovements())
                    <form action="{{ route('accounts.soft', $account->id) }}" method="POST">
                        @method('patch') 
                        @csrf
                        <button type="submit" class="btn btn-xs btn-danger"> Close </button>
                     </form>
                @endif
            @endif
            </td>
        </tr>
        @endforeach
</table>
@else
<h2>You have no associates.</h2>
@endif 
@endsection


