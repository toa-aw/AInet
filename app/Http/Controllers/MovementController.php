<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Account;
use App\Movement;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMovementRequest;
use App\Http\Requests\UpdateMovementRequest;

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
        
        $this->authorize('createMovement', $account);
        $movement = new Movement;
        return view('movements.add',compact('movement', 'account'));
    }

    public function edit(Movement $movement){
        $this->authorize('update', $movement);
        return view('movements.edit',compact('movement'));
    }

    public function store(StoreMovementRequest $request, Account $account)
    {
        $this->authorize('createMovement', $account);
        $data = $request->validated(); 
        $data['account_id'] = $account->id;
        $data['start_balance'] = $account->start_balance;
        $data['end_balance'] = $account->start_balance + $data['value'];
        Movement::create($data);    
        return redirect()
            ->route('movements', $account->id)
            ->with('success', 'Movement created successfully.');
    }

    public function update(UpdateMovementRequest $request, Movement $movement)
    {
        $this->authorize('update', $movement); 
        $data = $request->validated();
        $movement->fill($data);
        $movement->save();

        return redirect()
            ->route('movements', $movement->account_id)
            ->with('success', 'Movement saved successfully.');
    }

    public function delete(Movement $movement)
    {
        $this->authorize('delete', $movement);
        $movement->delete();

        return redirect()
            ->route('movements', $movement->account_id)
            ->with('success', 'Movement deleted successfully.');
    }
}
