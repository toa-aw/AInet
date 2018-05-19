<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editPassword()
    {
        $this->authorize('changePassword', Auth::user());
        return view('users.password_edit');    
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $this->authorize('changePassword', $user);
        $data = $request->validated();

        $pw = Hash::make($data['password']);
        $user->password = $pw;
        $user->save();

        return redirect()->route('home')->with('status', 'Password has been changed.');
    }
}
