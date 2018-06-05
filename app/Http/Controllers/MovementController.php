<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Account;
use App\Movement;
use Illuminate\Support\Facades\Auth;

class MovementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Account $account)
    {   
        $movements = Movement::where('account_id', $account->id)
                        ->orderBy('date', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(40);
        foreach($movements as $movement){
            $this->authorize('view', $movement);
        }
        return view('movements.index', compact('movements', 'account'));
    }

    public function create(Account $account){
        $movement = new Movement;
        return view('movements.add',compact('movement', 'account'));
    }

    public function edit(Movement $movement){
        return view('movements.edit',compact('movement'));
    }

    public function delete(Movement $movement)
    {
        $this->authorize('delete', $movement);
        $movement->delete();

        return redirect()
            ->route('movements.index')
            ->with('success', 'Movement deleted successfully.');
    }
}
