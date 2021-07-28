<?php

namespace Database\Seeders;

use App\Models\AssignedRules;
use App\Models\AuthorizationCategory;
use App\Models\Role;
use App\Models\Rule;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Edris',
            'last_name' => 'Malya',
            'email' => 'adrismalya@gmail.com',
            'password' => \Hash::make('Edris@123')
        ]);
        Role::insert([
            [
                "id" => 1,
                "name" => "Admin",
            ],
        ]);
        AuthorizationCategory::insert([
            [
                "id" => 1,
                "name" => "Users",
            ],
            [
                "id" => 2,
                "name" => "Rules",
            ],
            [
                "id" => 3,
                "name" => "Authorizations",
            ],
        ]);
        Rule::insert([
            [
                "id" => 23,
                "authorization_category_id" => 1,
                "name" => "View Users",
                "key" => "ViewUsers",
            ],
            [
                "id" => 24,
                "authorization_category_id" => 1,
                "name" => "Create User",
                "key" => "CreateUser",
            ],
            [
                "id" => 25,
                "authorization_category_id" => 1,
                "name" => "Edit User",
                "key" => "EditUser",
            ],
            [
                "id" => 26,
                "authorization_category_id" => 1,
                "name" => "DeleteUser",
                "key" => "DeleteUser",
            ],
            [
                "id" => 27,
                "authorization_category_id" => 2,
                "name" => "View Rules",
                "key" => "ViewRules",
            ],
            [
                "id" => 28,
                "authorization_category_id" => 2,
                "name" => "Create Rules",
                "key" => "CreateRules",
            ],
            [
                "id" => 30,
                "authorization_category_id" => 2,
                "name" => "DeleteRules",
                "key" => "DeleteRules",
            ],
            [
                "id" => 31,
                "authorization_category_id" => 3,
                "name" => "View Authorizations",
                "key" => "ViewAuthorizations",
            ],
            [
                "id" => 32,
                "authorization_category_id" => 3,
                "name" => "Create Category",
                "key" => "CreateCategory",
            ],
            [
                "id" => 33,
                "authorization_category_id" => 3,
                "name" => "Edit Category",
                "key" => "EditCategory",
            ],
            [
                "id" => 34,
                "authorization_category_id" => 3,
                "name" => "Delete Category",
                "key" => "DeleteCategory",
            ],
            [
                "id" => 35,
                "authorization_category_id" => 3,
                "name" => "View Roles",
                "key" => "ViewRoles",
            ],
            [
                "id" => 36,
                "authorization_category_id" => 3,
                "name" => "Create Roles",
                "key" => "CreateRoles",
            ],
            [
                "id" => 37,
                "authorization_category_id" => 3,
                "name" => "Edit Roles",
                "key" => "EditRoles",
            ],
            [
                "id" => 38,
                "authorization_category_id" => 3,
                "name" => "Delete Roles",
                "key" => "DeleteRoles",
            ],
        ]);
        AssignedRules::insert([
            [
                "id" => 1,
                "rule_id" => 1,
                "role_id" => 23,
            ],
            [
                "id" => 2,
                "rule_id" => 1,
                "role_id" => 24,
            ],
            [
                "id" => 3,
                "rule_id" => 1,
                "role_id" => 25,
            ],
            [
                "id" => 4,
                "rule_id" => 1,
                "role_id" => 26,
            ],
            [
                "id" => 5,
                "rule_id" => 1,
                "role_id" => 27,
            ],
            [
                "id" => 6,
                "rule_id" => 1,
                "role_id" => 28,
            ],
            [
                "id" => 7,
                "rule_id" => 1,
                "role_id" => 30,
            ],
            [
                "id" => 8,
                "rule_id" => 1,
                "role_id" => 31,
            ],
            [
                "id" => 9,
                "rule_id" => 1,
                "role_id" => 32,
            ],
            [
                "id" => 10,
                "rule_id" => 1,
                "role_id" => 33,
            ],
            [
                "id" => 11,
                "rule_id" => 1,
                "role_id" => 34,
            ],
            [
                "id" => 12,
                "rule_id" => 1,
                "role_id" => 38,
            ],
            [
                "id" => 13,
                "rule_id" => 1,
                "role_id" => 36,
            ],
            [
                "id" => 14,
                "rule_id" => 1,
                "role_id" => 35,
            ],
            [
                "id" => 15,
                "rule_id" => 1,
                "role_id" => 37,
            ],
        ]);
    }
}
