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

        $accounts = User::find(Auth::id())->accounts()->where('account_type_id', $data['account_type_id'])->get();
        if(count($accounts) > 0){
            redirect()
                ->route('accounts.create')
                ->with('errors', 'Account type already exits for this user!');
        }
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
        $this->authorize('update', $account);
        $data = $request->validated();
        $data['date'] = Carbon::now()->format('Y-m-d');
        $account->fill($data);
        $account->save();

        return redirect()
            ->route('home')
            ->with('success', 'Account saved successfully.');
    }
}
