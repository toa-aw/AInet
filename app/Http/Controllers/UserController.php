<?php

namespace App;
use Illuminate\Http\Request;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {   
        $users = \App\User::all();
        return view('users.index', compact('users'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function groupPrfofiles()
    {
        
    }

    public function edit()
    {
        $user = Auth::user();
        $this->authorize('editUser', $user);
        // dd($user);
        return view('users.user_edit', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $this->authorize('editUser', $user);;
        $data = $request->validated();

         $photo = null;
        if (isset($data['profile_photo'])) {
            $path =  $data['profile_photo']->store('profiles', 'public');
            $photo = basename($path);
         }
        
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'profile_photo' => $photo = $photo ?? $user['profile_photo'],
        ]);

        $user->save();
        
        return redirect()->route('home')->with('status', 'User updated succesfuly.');
    }

    public function editPassword()
    {
        $this->authorize('editUser', Auth::user());
        return view('users.password_edit');    
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $this->authorize('editUser', $user);
        $data = $request->validated();

        $pw = Hash::make($data['password']);
        $user->password = $pw;
        $user->save();

        return redirect()->route('home')->with('status', 'Password has been changed.');
    }
}
