<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Response;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $users = \App\User::all();
            return view('users.index', compact('users'));

        }
        return new Response('Forbidden', 403);


    }

    public function indexSearch(Request $request)
    {
        $name = $request('name');
    }
}
