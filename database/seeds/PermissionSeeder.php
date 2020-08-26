<?php

use Illuminate\Database\Seeder;
use App\Permission; 

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'Create',
            'slug' => 'create'
        ]);

        Permission::create([
            'name' => 'Edit',
            'slug' => 'edit'
        ]);

        Permission::create([
            'name' => 'Delete',
            'slug' => 'delete'
        ]);

        Permission::create([
            'name' => 'View',
            'slug' => 'view'
        ]);

        Permission::create([
            'name' => 'Config',
            'slug' => 'config'
        ]);
    }
}
