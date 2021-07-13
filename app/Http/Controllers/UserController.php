<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\Fluent\Concerns\Has;

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

    public function doRegister(Request $request)
    {
        $request->validate([
                               'email'    => 'required:email',
                               'password' => 'required',
                               'fullname' => 'required',
                               'phone_no' => 'required',
                           ]);

        if (Models\User::where('email', $request->get('email'))->get()->count() > 0) {
            return redirect()->back()->withInput()->with('error', 'Email has been used. Please use forgot password to retrieve your password');
        }

        $user           = new Models\User();
        $user->email    = $request->get('email');
        $user->password = \Hash::make($request->get('password'));
        $user->fullname = strtoupper($request->get('fullname'));
        $user->phone_no = $request->get('phone_no');
        $user->phone_no = str_replace('-', '', $user->phone_no);
        $user->phone_no = str_replace('+6', '', $user->phone_no);
        $user->phone_no = str_replace('+', '', $user->phone_no);
        $user->phone_no = str_replace(' ', '', $user->phone_no);
        $user->enable = 1;
        $user->save();

        $adminRole = Models\Role::where('name', 'customer')->first();
        $user->attachRole($adminRole);

        return redirect()->to('/')->with('success', 'Registration done. Please login');
    }

    public function forgot()
    {
        return view('forgot');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
        $input = $request->all();
        $user = Models\User::where('email', '=', $input['email'])->first();

        $rememberMe = isset($input['rememberme']) && $input['rememberme'] == 'on';
        if (\Auth::attempt(['email' => $input['email'], 'password' => $input['password']], $rememberMe)) {

            if (!$user->enable) {
                return redirect()->to('login')
                                 ->withInput($request->except('password'))
                                 ->with('error', 'Account not active. Please contact system administrator');
            }

            return redirect()->intended('/');
        }
        else {
            return redirect()->to('login')
                             ->withInput($request->except('password'))
                             ->with('error', 'Invalid credentials');
        }
    }

    public function dashboard()
    {
        if (Auth::user()->hasRole('admin')) {
            return view('dashboard.admin');
        } elseif (Auth::user()->hasRole('consultant')) {
            return view('dashboard.consultant');
        } else {
            return view('dashboard.customer');
        }
    }

    public function logout()
    {
        \Auth::logout();
        \Session::flush();

        return redirect()->to('/');
    }
}
