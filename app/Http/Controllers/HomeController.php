<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::count();
        $movements = \App\Movement::count();
        $accounts = \App\Account::count();

        return view('home', compact('users', 'movements', 'accounts'));

    }
}
