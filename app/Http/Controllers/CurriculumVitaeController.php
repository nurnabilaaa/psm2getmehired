<?php

namespace App\Http\Controllers;

use App\Libs\ToyyibPay;
use Illuminate\Http\Request;
use App\Models;

class CurriculumVitaeController extends Controller
{

    /*
    public function __construct()
    {
        $this->middleware(['permission:submit-new-cv'])->only(['manageAdmins']);
    }
    public function manageAdmins()
    {
        return view('admin.index');
    }
    */

    public function index()
    {
        $perPage = request()->get('perPage') != null ? request()->get('perPage') : 10;
        $keyword = request()->get('q');
        $cvs   = null;
        if (\Laratrust::hasRole('admin')) {
            $cvs = Models\VWCurriculumVitae::where(function ($query) use ($keyword) {
                if ($keyword) {
                    $query->whereRaw('`email` LIKE "%' . $keyword . '%"
                    OR `fullname` LIKE "%' . $keyword . '%"
                    OR `phone_no` LIKE "%' . $keyword . '%"
                    OR `package` LIKE "%' . $keyword . '%"
                    OR `status` LIKE "%' . $keyword . '%"
                    ');
                }
            })->sortable(['created_at' => 'asc'])->paginate($perPage);
        }

        $data = [
            'menu'  => ['menu' => 'CurriculumVitae', 'subMenu' => ''],
            'cvs' => $cvs
        ];

        return view('curriculum_vitae.index', $data);
    }

    public function pay($userId, $package)
    {
        $user  = Models\User::find($userId);

        $vitae              = new Models\CurriculumVitae();
        $vitae->customer_id = $user->id;
        $vitae->package     = $package;
        if ($package == 'CV Writing') {
            $vitae->price = 80;
        }
        else {
            $vitae->price = 50;
        }
        $vitae->is_paid = 0;
        $vitae->status  = 0;
        $vitae->save();

        $pg = new ToyyibPay();
        $pg->setBillName('Payment for ' . $vitae->package);
        $pg->setBillDescription(' ');
        $pg->setAmount($vitae->price);
        $pg->setReturnUrl(url('/'));
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
