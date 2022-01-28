<?php

namespace Database\Seeders\roles_and_permissions;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // User model
        $can_view_users = Permission::create(['name' => 'view users']);
        $can_view_profile = Permission::create(['name' => 'view profile']);
        $can_update_user = Permission::create(['name' => 'update user']);
        $can_delete_user = Permission::create(['name' => 'delete user']);
        $can_ban_user = Permission::create(['name' => 'ban user']);
        $can_create_user = Permission::create(['name' => 'create user']);

        // Question model

        $can_create_question = Permission::create(['name' => 'create question']);
        $can_view_questions = Permission::create(['name' => 'view questions']);
        $can_delete_question = Permission::create(['name' => 'delete question']);
        $can_update_question = Permission::create(['name' => 'update question']);
        $can_show_question = Permission::create(['name' => 'show question']);

        // Answer model

        $can_create_answer = Permission::create(['name' => 'create answer']);
        $can_view_answers = Permission::create(['name' => 'view answers']);
        $can_delete_answer = Permission::create(['name' => 'delete answer']);
        $can_update_answer = Permission::create(['name' => 'update answer']);

        // CategoryQuestion model

        $can_create_category = Permission::create(['name' => 'create category']);
        $can_view_categories = Permission::create(['name' => 'view categories']);
        $can_delete_category = Permission::create(['name' => 'delete category']);
        $can_update_category = Permission::create(['name' => 'update category']);


        // Finding roles
        $president_role = Role::query()->where('name','=','President')->first();
        $club_member_role = Role::query()->where('name','=','Club member')->first();
        $member_role = Role::query()->where('name','=','Member')->first();

        // Assign permissions to role

        $club_member_role->givePermissionTo([$can_view_questions, $can_view_answers, $can_view_categories, $can_show_question]);
        $member_role->givePermissionTo([$can_view_questions, $can_view_answers, $can_view_categories, $can_show_question]);
        $president_role->givePermissionTo(Permission::all());

    }
}
