<?php

namespace App\Http\Controllers;

use App\Libs\ToyyibPay;
use App\Mail\Activation;
use App\Mail\LostPassword;
use App\Mail\Welcome;
use App\Models;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['dashboard']);
    }

    public function index($for)
    {
        $perPage = request()->get('perPage') != null ? request()->get('perPage') : 10;
        $keyword = request()->get('q');
        $users   = null;
        if (\Laratrust::hasRole('admin')) {
            $users = Models\VWUsers::where('role', $for)->where(function ($query) use ($keyword) {
                if ($keyword) {
                    $query->whereRaw('`email` LIKE "%' . $keyword . '%"
                    OR `fullname` LIKE "%' . $keyword . '%"
                    OR `phone_no` LIKE "%' . $keyword . '%"');
                }
            })->sortable(['fullname' => 'asc'])->paginate($perPage);
        }

        $data = [
            'menu'  => ['menu' => $for, 'subMenu' => ''],
            'users' => $users,
            'for'   => $for
        ];

        return view('user.index', $data);
    }

    public function registerCustomer()
    {
        if (request()->isMethod('get')) {
            return view('auth.register_customer');
        } else {
            request()->validate([
                                    'fullname' => 'required',
                                    'email'    => 'required|email',
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
            $user->enable   = 1;
            $user->save();

            $vitae              = new Models\CurriculumVitae();
            $vitae->customer_id = $user->id;
            $vitae->package     = request()->get('package');
            if (request()->get('package') == 'CV Writing') {
                $vitae->price = 80;
            } else {
                $vitae->price = 50;
            }
            $vitae->is_paid = 0;
            $vitae->status  = 0;
            $vitae->save();

            $adminRole = Models\Role::where('name', 'customer')->first();
            $user->attachRole($adminRole);

            \Mail::to($user->email)
                 ->queue(new Welcome([
                                         'name' => strtoupper($user->fullname),
                                         'url'  => \URL::to('/')
                                     ]));

            return redirect()->to('pay/' . $user->id);
        }
    }

    public function registerConsultant()
    {
        if (request()->isMethod('get')) {
            return view('auth.register_consultant');
        } else {
            request()->validate([
                                    'fullname' => 'required',
                                    'email'    => 'required|email',
                                    'phone_no' => 'required',
                                    'cv'       => 'required',
                                    'password' => 'required|confirmed|min:6'
                                ]);

            $fileBase = request()->file('cv');
            $newName  = Uuid::uuid4()->getHex() . '.' . $fileBase->getClientOriginalExtension();
            $fileBase->move(public_path('cv'), $newName);

            if (Models\User::where('email', request()->get('email'))->get()->count() > 0) {
                return redirect()->back()->withInput()->with('error', 'Email has been used. Please use forgot password to retrieve your password');
            }

            $user                    = new Models\User();
            $user->email             = request()->get('email');
            $user->password          = \Hash::make(request()->get('password'));
            $user->fullname          = strtoupper(request()->get('fullname'));
            $user->phone_no          = request()->get('phone_no');
            $user->phone_no          = str_replace('-', '', $user->phone_no);
            $user->phone_no          = str_replace('+6', '', $user->phone_no);
            $user->phone_no          = str_replace('+', '', $user->phone_no);
            $user->phone_no          = str_replace(' ', '', $user->phone_no);
            $user->cv_filename       = $newName;
            $user->enable            = 0;
            $user->consultant_status = 0;
            $user->save();

            $consultantRole = Models\Role::where('name', 'consultant')->first();
            $user->attachRole($consultantRole);

            return redirect()->to('login')->with('success', 'Your request is being viewed. We will notify you soon.');
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
        } else {
            return redirect('https://toyyibpay.com/' . $billCode);
        }
    }

    public function login()
    {
        if (request()->isMethod('get')) {
            $paymentMsg    = null;
            $paymentStatus = null;
            if (request()->get('billcode') != null && request()->get('status_id') != null) {
                $vitae          = Models\CurriculumVitae::where('bill_code', request()->get('billcode'))->get()->first();
                $vitae->is_paid = request()->get('status_id');
                $vitae->save();
                if (request()->get('status_id') == 1) {
                    $paymentStatus = 'success';
                    $paymentMsg    = 'Thanks for your payment. Please login to submit your CV';
                } elseif (request()->get('status_id') == 3) {
                    $paymentStatus = 'failed';
                    $paymentMsg    = 'Payment failed. Try to resubmit a payment after login';
                } else {
                    $paymentStatus = 'pending';
                    $paymentMsg    = 'Payment pending.';
                }

                if (Auth::check()) {
                    return redirect()->to('/')->with('paymentStatus', $paymentStatus);
                }
            }
            $announcements = Models\Announcement::where('expired_at', '>=', date('Y-m-d'))->orderBy('expired_at')->get();

            return view('auth.login', ['announcements' => $announcements, 'paymentStatus' => $paymentStatus, 'paymentMsg' => $paymentMsg]);
        } else {
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
            } else {
                return redirect()->to('login')
                                 ->withInput(request()->except('password'))
                                 ->with('error', 'Invalid credentials');
            }
        }
    }

    public function lostPassword()
    {
        if (request()->isMethod('get')) {
            return view('auth.lost_password');
        } else {
            $user = Models\User::where('email', '=', request()->input('email'))->first();

            if ($user == null) {
                return redirect()->to('password/lost')->with('error', 'Username not found');
            }

            if ($user->enable) {
                $user->reset_password_token = Uuid::uuid4()->getHex();
                \Mail::to($user->email)
                     ->queue(new LostPassword([
                                                  'name' => strtoupper($user->fullname),
                                                  'url'  => \URL::to('password/reset/' . $user->reset_password_token)
                                              ]));

                $user->save();

                return redirect()->to('login')->with('success', 'Reset password instruction has been sent to your email');
            } else {
                return redirect()->to('password/lost')->with('error', 'Your account is not active');
            }
        }
    }

    public function newPassword($token)
    {
        if (request()->isMethod('get')) {
            $user = Models\User::where('reset_password_token', $token)->first();
            if ($user) {
                return view('auth.reset_password', ['user' => $user]);
            } else {
                return redirect()->to('login')->with('error', 'Invalid token');
            }
        } else {
            request()->validate(['password' => 'required|confirmed|min:6']);
            $user                       = Models\User::where('reset_password_token', $token)->first();
            $user->reset_password_token = null;
            $user->password             = \Hash::make(request()->input('password'));
            $user->save();

            return redirect()->to('login')->with('success', 'Your password has been change');
        }
    }

    public function dashboard()
    {
        $data = [
            'menu' => ['menu' => 'Home', 'subMenu' => ''],
        ];

        if (Auth::user()->hasRole('admin')) {
            $data['totalCV']         = Models\CurriculumVitae::selectRaw('COUNT(*) as total')->get()->first();
            $data['totalCompleted']  = Models\CurriculumVitae::selectRaw('COUNT(*) as total')->where('status', 3)->get()->first();
            $data['totalOnProgress'] = Models\CurriculumVitae::selectRaw('COUNT(*) as total')->where('status', 2)->get()->first();
            $data['totalNotPickup']  = Models\CurriculumVitae::selectRaw('COUNT(*) as total')->where('status', 1)->get()->first();
            $data['totalCustomer']   = Models\VWUsers::selectRaw('COUNT(*) as total')->where('role', 'customer')->get()->first();
            $data['totalConsultant'] = Models\VWUsers::selectRaw('COUNT(*) as total')->where('role', 'consultant')->get()->first();
            $data['totalIncome']     = Models\CurriculumVitae::selectRaw('SUM(price) as total')->get()->first();
            return view('dashboard.admin', $data);
        } elseif (Auth::user()->hasRole('consultant')) {
            $data['cvs']          = Models\VWCurriculumVitae::where('customer_id', Auth::user()->id)->get();
            $data['unpickCvs']    = Models\VWCurriculumVitae::where('status', 1)->orderBy('created_at')->get();
            $data['onWorkingCvs'] = Models\VWCurriculumVitae::where('status', 2)
                                                            ->where('consultant_id', auth()->user()->id)
                                                            ->orderBy('created_at')->get();
            $data['finishCvs']    = Models\VWCurriculumVitae::where('status', 3)
                                                            ->where('consultant_id', auth()->user()->id)
                                                            ->orderBy('created_at')->get();

            return view('dashboard.consultant', $data);
        } elseif (Auth::user()->hasRole('customer')) {
            $paymentStatus = null;
            if (session()->get('paymentStatus') != null) {
                $paymentStatus = session()->get('paymentStatus');
            } elseif (request()->get('status_id') !== null) {
                $vitae          = Models\CurriculumVitae::where('bill_code', request()->get('billcode'))->get()->first();
                $vitae->is_paid = request()->get('status_id');
                $vitae->save();
                if (request()->get('status_id') == 1) {
                    $paymentStatus = 'success';
                } elseif (request()->get('status_id') == 3) {
                    $paymentStatus = 'failed';
                } else {
                    $paymentStatus = 'pending';
                }
            }
            $data['cvs']        = Models\VWCurriculumVitae::where('customer_id', Auth::user()->id)->get();
            $data['paymentStatus'] = $paymentStatus;

            return view('dashboard.customer', $data);
        }
    }

    public function activation($id)
    {
        if (\Request::isMethod('get')) {
            $user = Models\User::find($id);
            $data = [
                'user' => $user
            ];

            if ($user == null) {
                return redirect()->to('login')->with('error', 'User not found');
            } elseif ($user->password != null) {
                return redirect()->to('login')->with('error', 'User already active');
            }

            return view('auth.activate', $data);
        } else {
            request()->validate([
                                    'password' => 'required|confirmed|min:6'
                                ]);

            $user           = Models\User::find($id);
            $user->password = \Hash::make(request()->input('password'));
            $user->enable   = 1;
            if ($user->hasRole('consultant')) {
                $user->consultant_status = 1;
            }
            $user->save();

            return redirect()->to('login')->with('success', 'Your account has been activate. Please login');
        }
    }

    public function create($for)
    {
        $data = [
            'menu' => ['menu' => $for, 'subMenu' => ''],
            'for'  => $for
        ];

        return view('user.form', $data);
    }

    public function store($for)
    {
        $check = Models\User::where('email', request()->get('email'))->get();
        if ($check->count() > 0) {
            return redirect()->back()->withInput()->with('error', 'That email has been used. Try another email, or update existing one');
        }

        $user           = new Models\User();
        $user->email    = request()->get('email');
        $user->fullname = strtoupper(request()->get('fullname'));
        $user->phone_no = request()->get('phone_no');
        $user->phone_no = str_replace('-', '', $user->phone_no);
        $user->phone_no = str_replace('+6', '', $user->phone_no);
        $user->phone_no = str_replace('+', '', $user->phone_no);
        $user->phone_no = str_replace(' ', '', $user->phone_no);
        if ($for == 'consultant') {
            $user->consultant_status = 1;
        }
        $user->enable = 0;
        $user->save();
        if ($for == 'admin') {
            $adminRole = Models\Role::where('name', 'admin')->first();
            $user->attachRole($adminRole);
        } elseif ($for == 'consultant') {
            $consultantRole = Models\Role::where('name', 'consultant')->first();
            $user->attachRole($consultantRole);
        } elseif ($for == 'customer') {
            $customerRole = Models\Role::where('name', 'customer')->first();
            $user->attachRole($customerRole);
        }

        \Mail::to($user->email)
             ->queue(new Activation([
                                        'name' => strtoupper($user->fullname),
                                        'url'  => \URL::to('activate/' . $user->id)
                                    ]));

        if ($for == 'admin') {
            return redirect()->to('user/index/admin')->with('success', 'Admin has been created');
        } elseif ($for == 'consultant') {
            return redirect()->to('user/index/consultant')->with('success', 'Consultant has been created');
        } elseif ($for == 'customer') {
            return redirect()->to('user/index/customer')->with('success', 'Customer has been created');
        }
    }

    public function edit($for, $id)
    {
        if ($for == 'profile') {
            if (Auth::user()->id != $id) {
                return redirect()->to('profile')->with('error', 'Not your profile!');
            }
        }

        $user = Models\User::find($id);
        $data = [
            'menu' => ['menu' => $for, 'subMenu' => ''],
            'for'  => $for,
            'user' => $user
        ];

        return view('user.form', $data);
    }

    public function update($for, $id)
    {
        $user           = Models\User::find($id);
        $user->email    = request()->get('email');
        $user->fullname = strtoupper(request()->get('fullname'));
        $user->phone_no = request()->get('phone_no');
        $user->phone_no = str_replace('-', '', $user->phone_no);
        $user->phone_no = str_replace('+6', '', $user->phone_no);
        $user->phone_no = str_replace('+', '', $user->phone_no);
        $user->phone_no = str_replace(' ', '', $user->phone_no);

        if ($for == 'consultant') {
            $user->consultant_status = request()->get('consultant_status');
        }
        $user->enable = request()->get('enable');
        $user->save();

        if ($for == 'profile') {
            return redirect()->to('profile')->with('success', 'Your profile has been updated');
        } else {
            return redirect()->to('user/index/' . $for)->with('success', 'User has been updated');
        }
    }

    public function profile()
    {
        $data = [
            'menu' => ['menu' => 'Home', 'subMenu' => ''],
            'user' => Auth::user(),
        ];

        return view('user.profile', $data);
    }

    public function changePassword()
    {
        if (\Request::isMethod('get')) {
            $data = [
                'menu' => ['menu' => 'Home', 'subMenu' => ''],
            ];
            return view('user.change_password', $data);
        } else {
            request()->validate(['password' => 'required|confirmed|min:6']);

            $user = Models\User::find(\Auth::user()->id);

            if (!\Hash::check(request()->get('old_password'), $user->password)) {
                return redirect()->to('password')->with('error', 'Invalid old password');
            } else {
                $user->password = \Hash::make(request()->get('password'));
                $user->save();

                return redirect()->to('password')->with('success', 'Password has been change.');
            }
        }
    }

    public function destroy($for, $id)
    {
        $hasLink      = false;
        $user         = Models\User::find($id);
        $announcement = Models\Announcement::where('announce_by', $id)->get();
        $hasLink      = $announcement->count() > 0;
        if (!$hasLink) {
            $cv      = Models\CurriculumVitae::where('customer_id', $id)->orWhere('consultant_id', $id)->get();
            $hasLink = $cv->count() > 0;
        }

        if ($hasLink) {
            $user->enable = 0;
            $user->save();
            if ($for == 'admin') {
                return redirect()->to('user/index/admin')->with('success', 'Admin has relation with other data. DISABLE this admin');
            } elseif ($for == 'consultant') {
                return redirect()->to('user/index/consultant')->with('success', 'Consultant has relation with other data. DISABLE this admin');
            } elseif ($for == 'customer') {
                return redirect()->to('user/index/customer')->with('success', 'Customer has relation with other data. DISABLE this admin');
            }
        } else {
            if ($user->hasRole('admin')) {
                $user->detachRole('admin');
            }
            if ($user->hasRole('consultant')) {
                $user->detachRole('consultant');
            }
            if ($user->hasRole('customer')) {
                $user->detachRole('customer');
            }
            $user->delete();
            if ($for == 'admin') {
                return redirect()->to('user/index/admin')->with('success', 'Admin has been deleted');
            } elseif ($for == 'consultant') {
                return redirect()->to('user/index/consultant')->with('success', 'Consultant has been deleted');
            } elseif ($for == 'customer') {
                return redirect()->to('user/index/customer')->with('success', 'Customer has been deleted');
            }
        }
    }

    public function logout()
    {
        \Auth::logout();
        \Session::flush();

        return redirect()->to('/');
    }
}
