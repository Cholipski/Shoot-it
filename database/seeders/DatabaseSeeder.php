<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\roles_and_permissions\PermissionSeeder;
use Database\Seeders\roles_and_permissions\RoleSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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

        $admin = User::create([
            'first_name' => "Admin",
            'last_name' => "Admin",
            'email' => "admin@admin.pl",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole(Role::query()->where('name','=','president')->first());

    }
}
