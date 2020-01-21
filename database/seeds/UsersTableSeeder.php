<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();

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
