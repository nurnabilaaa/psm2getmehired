<?php

namespace App\Http\Controllers;

use App\Models;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AnnouncementController extends Controller
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
        $perPage       = request()->get('perPage') != null ? request()->get('perPage') : 10;
        $keyword       = request()->get('q');
        $announcements = null;
        if (\Laratrust::hasRole('admin')) {
            $announcements = Models\Announcement::where(function ($query) use ($keyword) {
                if ($keyword) {
                    $query->whereRaw('`title` LIKE "%' . $keyword . '%"
                    OR `content_type` LIKE "%' . $keyword . '%"
                    OR `content_body` LIKE "%' . $keyword . '%"
                    OR `expired_at` LIKE "%' . $keyword . '%"
                    ');
                }
            })->sortable(['expired_at' => 'desc'])->paginate($perPage);
        }

        $data = [
            'menu'          => ['menu' => 'announcement', 'subMenu' => ''],
            'announcements' => $announcements
        ];

        return view('announcement.index', $data);
    }

    public function create()
    {
        $data = [
            'menu' => ['menu' => 'announcement', 'subMenu' => '']
        ];

        return view('announcement.form', $data);
    }

    public function store()
    {
        if (request()->get('content_type') == 'text') {
            request()->validate([
                                    'title'        => 'required',
                                    'content_type' => 'required',
                                    'expired_at'   => 'required',
                                    'content_text' => 'required',
                                ]);
        }
        else {
            request()->validate([
                                    'title'         => 'required',
                                    'content_type'  => 'required',
                                    'expired_at'    => 'required',
                                    'content_image' => 'required',
                                ]);
        }

        $announcement               = new Models\Announcement();
        $announcement->title        = request()->get('title');
        $announcement->content_type = request()->get('content_type');
        $announcement->expired_at   = date('Y-m-d', strtotime(request()->get('expired_at')));
        $announcement->announce_by  = \Auth::user()->id;

        if (request()->get('content_type') == 'text') {
            $announcement->content_body = request()->get('content_text');
        }
        else {
            $fileBase = request()->file('content_image');
            $newName  = Uuid::uuid4()->getHex() . '.' . $fileBase->getClientOriginalExtension();
            $fileBase->move(public_path('images' . DIRECTORY_SEPARATOR . 'announcement'), $newName);
            $announcement->content_body = $newName;
        }

        $announcement->save();

        return redirect()->to('announcement')->with('success', 'Announcement has been created');
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

    public function uploadCV($id)
    {
        $cv = Models\CurriculumVitae::find($id);

        $fileBase = request()->file('cv');
        $newName  = Uuid::uuid4()->getHex() . '.' . $fileBase->getClientOriginalExtension();
        $fileBase->move(public_path('cv'), $newName);

        $cv->cv_origin_filename = $newName;
        $cv->status             = 1;
        $cv->save();

        return redirect()->back()->with('success', 'Your CV has been upload');
    }

    public function pickupCV($id)
    {
        $cv                = Models\CurriculumVitae::find($id);
        $cv->status        = 2;
        $cv->consultant_id = \Auth::user()->id;
        $cv->save();

        return redirect()->back()->with('success', 'CV has been pickup');
    }

    public function finishCV($id)
    {
        $cv = Models\CurriculumVitae::find($id);

        $fileBase = request()->file('cv');
        $newName  = Uuid::uuid4()->getHex() . '.' . $fileBase->getClientOriginalExtension();
        $fileBase->move(public_path('cv'), $newName);

        $cv->cv_modified_filename = $newName;
        $cv->status               = 3;
        $cv->save();

        return redirect()->back()->with('success', 'Thanks for your contribution');
    }
}
