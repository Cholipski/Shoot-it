<?php

namespace Database\Seeders\roles_and_permissions;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name'=>'President']);
        Role::create(['name'=>'Club member']);
        Role::create(['name'=>'Member']);
    }
}
