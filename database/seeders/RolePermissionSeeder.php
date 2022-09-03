<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        Permission::create([
            'permission'=> 'view user'
        ]);

        Permission::create([
            'permission'=> 'add user'
        ]);

        Permission::create([
            'permission'=> 'update user'
        ]);

        Permission::create([
            'permission'=> 'delete user'
        ]);
    }
}
