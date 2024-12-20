<?php

namespace Database\Seeders;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $userRole = Role::create(['name'=>RolesEnum::User->value]);
        $commenterRole = Role::create(['name'=>RolesEnum::Commenter->value]);
        $adminRole = Role::create(['name'=>RolesEnum::Admin->value]);

        $manageFeaturesPermission = Permission::create(['name'=> PermissionsEnum::ManageFeatures->value]);
        $manageCommentsermission = Permission::create(['name'=> PermissionsEnum::ManageComments->value]);
        $manageUsersPermission = Permission::create(['name'=> PermissionsEnum::ManageUsers->value]);
        $upvoteDownvotePermission = Permission::create(['name'=> PermissionsEnum::UpvoteDownvote->value]);

        $userRole->syncPermissions([$upvoteDownvotePermission]);
        $commenterRole->syncPermissions([$manageCommentsermission, $upvoteDownvotePermission]);
        $adminRole->syncPermissions([$manageCommentsermission, $manageFeaturesPermission, $upvoteDownvotePermission, $manageUsersPermission]);


        User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
        ])->assignRole(RolesEnum::User);
        User::factory()->create([
            'name' => 'Commenter',
            'email' => 'commenter@gmail.com',
        ])->assignRole(RolesEnum::Commenter);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ])->assignRole(RolesEnum::Admin);
    }
}
