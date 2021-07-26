<?php

namespace App\Http\Controllers;

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
