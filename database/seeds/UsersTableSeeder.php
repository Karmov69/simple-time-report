<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Role as RoleConst;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $userAdmin = \App\User::create([
            'name' => 'admin',
            'lastname' => 'testLastName',
            'email' => 'info@pugofka.com',
            'plane_hours' => 0,
            'week_hours' => 0,
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
        ]);

        Role::create(['name' => RoleConst::ROLE_ADMIN]);
        Role::create(['name' => RoleConst::ROLE_USER]);
        $userAdmin->assignRole(RoleConst::ROLE_ADMIN);
    }
}
