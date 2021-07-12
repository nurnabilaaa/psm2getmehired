<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roles = Role::all(); // Pull back a given role
        foreach ($roles as $role) {
            // Regular Delete
            $role->delete(); // This will work no matter what
            // Force Delete
            $role->users()->sync([]); // Delete relationship data
            $role->permissions()->sync([]); // Delete relationship data
            $role->forceDelete();
        }

        $permissions = Permission::all(); // Pull back a given role
        foreach ($permissions as $permission) {
            $permission->forceDelete();
        }

        $admin      = Role::create([
                                       'name'         => 'admin',
                                       'display_name' => 'Admin',
                                       'description'  => 'Control all function application',
                                   ]);
        $customer   = Role::create([
                                       'name'         => 'customer',
                                       'display_name' => 'Customer',
                                       'description'  => 'Customer who submit and paid for CV checking',
                                   ]);
        $consultant = Role::create([
                                       'name'         => 'consultant',
                                       'display_name' => 'Consultant',
                                       'description'  => 'Customer who check for CV and get paid',
                                   ]);

        $submitCV = Permission::create([
                                           'name'         => 'submit-new-cv',
                                           'display_name' => 'Submit New CV', // optional
                                           'description'  => 'Customer submit CV', // optional
                                       ]);

        $listUnpickCV = Permission::create([
                                               'name'         => 'list-unpick-cv',
                                               'display_name' => 'CV To Pickup', // optional
                                               'description'  => 'CV to pickup by consultant', // optional
                                           ]);
        $customer->attachPermission($submitCV);
        $consultant->attachPermission($listUnpickCV);

        return view('home');
    }
}
