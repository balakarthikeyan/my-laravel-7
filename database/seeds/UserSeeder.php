<?php

use Illuminate\Database\Seeder;
use App\User; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('slug','developer')->first();
        $permission = Permission::where('slug','create-tasks')->first();

        $user = new User();
        $user->name = 'Jhon Deo';
        $user->email = 'jhon.deo@example.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->roles()->attach($role);
        $user->permissions()->attach($permission);
    }
}
