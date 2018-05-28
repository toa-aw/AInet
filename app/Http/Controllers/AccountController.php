<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        $account = new Account;
        return view('accounts.add',compact('account'));
    }

    public function store(StoreAccountRequest $request)
    {
        $user = Auth::id();
        $data = $request->validated();
        $data['owner_id'] = $user; 
        $data['current_balance'] = $data['start_balance'];        
        Account::create($data);    
        return redirect()
            ->route('home')
            ->with('success', 'Account created successfully.');
    }

    public function edit(Account $account)
    {
        $this->authorize('update', $account);
        return view('accounts.edit', compact('account'));
    }

    public function update(UpdateAccountRequest $request, Account $account)
    {
        //$this->authorize('update', $account); 
        $data = $request->validated();
        $start_balance = $account->start_balance;
        $current_balance = $account->current_balance;
        $account->fill([
            'account_type_id' => $data['account_type_id'],
            'date' => $account->date,
            'code' => $data['code'],            
            'description' => $data['description'] ?? null,            
            'start_balance' => $data['start_balance'],
            'current_balance' => $start_balance + $current_balance + $data['start_balance'],
            'last_movement_date' => Carbon::now()->format('Y-m-d'),
        ]);
        
        if($request->has('start_balance')){
            if($account->current_balance >= 0 && $account->current_balance > $current_balance){
                $movement = $account->movements()->create([
                    "movement_category_id" => 6,
                    "date" => Carbon::now()->format('Y-m-d'),
                    "value" => $start_balance,
                    "start_balance" => $data['start_balance'],
                    "end_balance" => $data['start_balance'] - $start_balance,
                    "type" => 'expense',
                ]);
            }

            $movement = $account->movements()->create([
                "movement_category_id" => 8,
                "date" => Carbon::now()->format('Y-m-d'),
                "value" => $start_balance,
                "start_balance" => $data['start_balance'],
                "end_balance" => $data['start_balance'] - $start_balance,
                "type" => 'revenue',
            ]);

            $movement->save();
        }
        $account->save();

        return redirect()
            ->route('home')
            ->with('success', 'Account saved successfully.');
    }
}
