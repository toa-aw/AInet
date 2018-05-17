<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use \App\User;
use \Illuminate\Http\Response;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
          $this->authorize('list', User::class);       
            $users = User::query();

            if($request->input('name')){
                $users = $users->findUsersByName($request->name);   
            }

            if($request->input('type')){
                    $users = $users->findUsersByRank($request->type);
            }

            if($request->input('status')){
                $users = $users->findUsersByStatus($request->status);
            }
            
            
            //dd($users->toSql());
            $users = $users->paginate(40);
            return response()->view('users.index', compact('users'));
    }
    
    public function block(User $user){       
        $this->authorize('alterStatus', $user);
                $user['blocked'] = true;
                $user->save();
                return redirect()->route('users')->with('success', 'User'.$user['name'].'has been blocked.');
    }

    public function unblock(User $user){
        $this->authorize('alterStatus', $user);

                $user['blocked'] = false;
                $user->save();
                return redirect()->route('users')->with('success', 'User'.$user['name'].'has been unblocked');        
    }

    public function promote(User $user){
        $this->authorize('alterRank', $user);

             $user['admin'] = true;
             $user->save();
             return redirect()->route('users')->with('success', 'User'.$user['name'].'has been promoted.');
    }

    public function demote(User $user){
       $this->authorize('alterRank', $user);

                $user['admin'] = false;
                $user->save();
                return redirect()->route('users')->with('success', 'User'.$user['name'].'has been demoted.');
    }

}
