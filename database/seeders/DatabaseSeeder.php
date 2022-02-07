<?php

namespace Database\Seeders;

use Database\Seeders\roles_and_permissions\PermissionSeeder;
use Database\Seeders\roles_and_permissions\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
