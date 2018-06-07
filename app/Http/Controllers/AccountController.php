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

    public function delete(Account $account)
    {
        $this->authorize('delete', $account);
        $account->delete();
        // return back();
        return redirect()->route('home')->with('success', 'Account created successfully.');

    }

    public function softDelete(Account $account)
    {
        $this->authorize('delete', $account);
        $account->deleted_at = Carbon::now();
        $account->save();
        return back();
        // return redirect()->route('home')->with('success', 'Account created successfully.');

    }

    public function reOpen(Account $account)
    {
        $this->authorize('delete', $account);
        $account->deleted_at = NULL;
        $account->save();
        return back();
        // return redirect()->route('home')->with('success', 'Account created successfully.');

    }

    public function listAccounts (User $user)
    {
        // $this->authorize('list');
        $accounts =  $user->accounts()->get();
        return view('accounts.list', compact('accounts'));

    }

    public function listOpenAccounts (User $user)
    {
        // $this->authorize('list');
        
        $accounts =  $user->accounts()->whereNull('deleted_at')->get();
        return view('accounts.list', compact('accounts'));

    }

    public function listClosedAccounts (User $user)
    {
        // $this->authorize('list');
        $accounts =  $user->accounts()->whereNotNull('deleted_at')->get();
        return view('accounts.list', compact('accounts'));

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
        if(!$request->has('date')){
            $data['date'] = Carbon::now()->format('Y-m-d');
        }            
                   
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
        //dd($account->id);
        $this->authorize('update', $account); 
        $data = $request->validated();
        $start_balance = $account->start_balance;
        $current_balance = $account->current_balance;
        $account->fill([
            'account_type_id' => $data['account_type_id'],
            'date' => $data['date'] ?? $account->date,
            'code' => $data['code'],            
            'description' => $data['description'] ?? null,            
            'start_balance' => $data['start_balance'],
            'current_balance' => $current_balance - ($start_balance - $data['start_balance']),
            'last_movement_date' => Carbon::now()->format('Y-m-d'),
        ]);
        $account->save();

        if($request->has('start_balance')){
            foreach ($account->movements as $movement){
                $m_start_balance = $movement->start_balance;
                $end_balance = $movement->end_balance;
                $value = $movement->value;
                //$movement->type == 'revenue'
                if($data['start_balance'] >= $m_start_balance){   
                    //dd($start_balance + ($data['start_balance'] - $start_balance));
                    $movement->fill([
                        'start_balance' => $m_start_balance + ($data['start_balance'] - $m_start_balance),
                        'end_balance' => $end_balance + ($data['start_balance'] - $m_start_balance),
                        //'end_balance' => $movement->start_balance + $value,
                    ]);               
                }else{
                    //dd($start_balance + ($start_balance - $data['start_balance']);     
                    $movement->fill([
                        'start_balance' => $m_start_balance + ($m_start_balance - $data['start_balance']),
                        'end_balance' => $end_balance + ($m_start_balance - $data['start_balance']),
                        //'end_balance' => $movement->start_balance + $value,
                    ]);
                }                      
                $movement->save();
            }              
        }      

        return redirect()
            ->route('home')
            ->with('success', 'Account saved successfully.');
    }
}
