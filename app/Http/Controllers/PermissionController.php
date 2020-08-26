<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use App\User;

class PermissionController extends Controller
{
    public function index()
    {   

		// Add Role Based Permission
		// $dev_permission = Permission::where('slug','delete')->first();
		// $dev_role = Role::where('slug','developer')->first();
		// $dev_role->permissions()->attach($dev_permission);

		// Delete Role Based Premission
		// $dev_permission = Permission::where('slug', 'delete')->first();
		// $dev_role = Role::where('slug','developer')->first();
		// $dev_role->permissions()->detach($dev_permission);

		// Create Role
        // $dev_permission = Permission::where('slug','create')->first();
		// $createRole = new Role();
		// $createRole->slug = 'developer';
		// $createRole->name = 'Developer';
		// $createRole->save();
		// $createRole->permissions()->attach($dev_permission);

		// Create Premission
		// $dev_role = Role::where('slug','developer')->first();
		// $createPermission = new Permission();
		// $createPermission->slug = 'create';
		// $createPermission->name = 'Create';
		// $createPermission->save();
		// $createPermission->roles()->attach($dev_role);

		// Create User
		// $developer = new User();
		// $developer->name = 'Developer';
		// $developer->email = 'developer@example.com';
		// $developer->password = bcrypt('password');
		// $developer->save();
		// $developer->roles()->attach($dev_role);
		// $developer->permissions()->attach($dev_permission);

		// return redirect()->back();
		$response = Permission::all()->get();   
		return response()->json([
			'result' => $response,
		]);
			
    }
}
