<?php

namespace App\Http\Controllers;

use App\Libs\ToyyibPay;
use App\Mail\LostPassword;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

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
        if (request()->isMethod('get')) {
            return view('auth.register');
        }
        else {
            request()->validate([
                                    'fullname' => 'required',
                                    'email'    => 'required:email',
                                    'phone_no' => 'required',
                                    'package'  => 'required',
                                    'password' => 'required|confirmed|min:6'
                                ]);

            if (Models\User::where('email', request()->get('email'))->get()->count() > 0) {
                return redirect()->back()->withInput()->with('error', 'Email has been used. Please use forgot password to retrieve your password');
            }

            $user           = new Models\User();
            $user->email    = request()->get('email');
            $user->password = \Hash::make(request()->get('password'));
            $user->fullname = strtoupper(request()->get('fullname'));
            $user->phone_no = request()->get('phone_no');
            $user->phone_no = str_replace('-', '', $user->phone_no);
            $user->phone_no = str_replace('+6', '', $user->phone_no);
            $user->phone_no = str_replace('+', '', $user->phone_no);
            $user->phone_no = str_replace(' ', '', $user->phone_no);
            $user->enable   = 0;
            $user->save();

            $vitae              = new Models\CurriculumVitae();
            $vitae->customer_id = $user->id;
            $vitae->package     = request()->get('package');
            if (request()->get('package') == 'CV Writing') {
                $vitae->price = 80;
            }
            else {
                $vitae->price = 50;
            }
            $vitae->is_paid = 0;
            $vitae->status  = 0;
            $vitae->save();

            $adminRole = Models\Role::where('name', 'customer')->first();
            $user->attachRole($adminRole);

            return redirect()->to('pay/' . $user->id);
        }
    }

    public function pay($userId)
    {
        $user  = Models\User::find($userId);
        $vitae = Models\CurriculumVitae::where('customer_id', $user->id)->where('is_paid', 0)->get()->first();

        $pg = new ToyyibPay();
        $pg->setBillName('Payment for ' . $vitae->package);
        $pg->setBillDescription(' ');
        $pg->setAmount($vitae->price);
        $pg->setReturnUrl(url('login'));
        $pg->setBillTo($user->fullname);
        $pg->setBillEmail($user->email);
        $pg->setBillPhone($user->phone_no);
        $billCode = $pg->createBill();

        $vitae->bill_code = $billCode;
        $vitae->save();

        if (env('TOYYIBPAY_DEV') == 'yes') {
            return redirect('https://dev.toyyibpay.com/' . $billCode);
        }
        else {
            return redirect('https://toyyibpay.com/' . $billCode);
        }
    }

    public function toyyibpayCallback()
    {
        $vitae          = Models\CurriculumVitae::where('bill_code', request()->get('billcode'))->get()->first();
        $vitae->is_paid = request()->get('status');
        $vitae->save();
    }

    public function login()
    {
        if (request()->isMethod('get')) {
            if (request()->get('billcode') != null && request()->get('status_id') != null) {
                $paymentStatus = 'success';
                $paymentMsg    = null;
                $vitae          = Models\CurriculumVitae::where('bill_code', request()->get('billcode'))->get()->first();
                $vitae->is_paid = request()->get('status_id');
                $vitae->save();
                if (request()->get('status_id') == 1) {
                    $paymentMsg = 'Thanks for your payment, please login after activation';
                }
                elseif (request()->get('status_id') == 3) {
                    $paymentStatus = 'failed';
                    $paymentMsg    = 'Payment failed. Try to resubmit a payment after login. Please activate your account first';
                }
            }

            return view('auth.login', ['paymentStatus' => $paymentStatus, 'paymentMsg' => $paymentMsg]);
        }
        else {
            $input = request()->all();
            $user  = Models\User::where('email', '=', $input['email'])->first();

            $rememberMe = isset($input['rememberme']) && $input['rememberme'] == 'on';
            if (\Auth::attempt(['email' => $input['email'], 'password' => $input['password']], $rememberMe)) {

                if (!$user->enable) {
                    return redirect()->to('login')
                                     ->withInput(request()->except('password'))
                                     ->with('error', 'Account not active. Please contact system administrator');
                }

                return redirect()->intended('/');
            }
            else {
                return redirect()->to('login')
                                 ->withInput(request()->except('password'))
                                 ->with('error', 'Invalid credentials');
            }
        }
    }

    public function lostPassword($token = null)
    {
        if (request()->isMethod('get')) {
            return view('auth.lost_password');
        }
        else {
            $user = Models\User::where('email', '=', request()->input('username'))->first();

            if ($user == null) {
                return redirect()->to('password/lost')->with('error', 'Username not found');
            }

            if ($user->enable && $user->email_verified_at != null) {
                $user->token = Uuid::uuid4()->getHex();
                \Mail::to($user->email)
                     ->queue(new LostPassword([
                                                  'name' => strtoupper($user->fullname),
                                                  'url'  => \URL::to('password/reset/' . $user->token),
                                              ]));

                $user->save();

                return redirect()->to('login')->with('success', 'Reset password instruction has been sent to your email');
            }
            else {
                return redirect()->to('password/lost')->with('error', 'Your account is not active');
            }
        }
    }

    public function dashboard()
    {
        $data = [
            'menu' => ['menu' => 'Home', 'subMenu' => ''],
        ];

        if (Auth::user()->hasRole('admin')) {
            return view('dashboard.admin', $data);
        }
        elseif (Auth::user()->hasRole('consultant')) {
            return view('dashboard.consultant', $data);
        }
        else {
            return view('dashboard.customer', $data);
        }
    }

    public function logout()
    {
        \Auth::logout();
        \Session::flush();

        return redirect()->to('/');
    }
}
