<?php

use Illuminate\Database\Seeder;
use Blog\Models\User;
use Blog\Models\Role;
use Blog\Services\RoleService;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function ($u) {
            $roleService = app(RoleService::class);
            $role = $roleService->find(Role::ROLE_REGISTERED_USER);
            $u->roles()->save($role); 
        });;
    }
}
