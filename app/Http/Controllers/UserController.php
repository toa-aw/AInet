<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class UserController extends Controller


{
    public function index()
    {   
        $users = \App\User::all();
        return view('users.index', compact('users'));
    }

    public function indexSearch(Request $request)
    {
        $name = $request('name');
    }


}

