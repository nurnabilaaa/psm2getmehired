<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['dashboard']);
    }

    public function index()
    {
        return view('user.index');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function forgot()
    {
        return view('forgot');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
