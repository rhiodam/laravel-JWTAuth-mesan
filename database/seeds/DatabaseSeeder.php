<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        DB::table('users')->delete();


        //1) Create Admin Role
        $role = [
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Full Permission'
        ];
        $role = Role::create($role);


        //2) Set Role Permissions
        // Get all permission, swift through and attach them to the role
        $permission = Permission::get();
        foreach ($permission as $key => $value) {
            $role->attachPermission($value);
        }


        //3) Create Admin User
        $user = [
            'name' => 'Admin User',
            'age' => '25',
            'username' => 'Admin User',
            'email' => 'dev.cerdas.skd@gmail.com',
            'password' => Hash::make('dev.cerdas'),
            'plainpassword' => ('dev.cerdas')
        ];
        $user = User::create($user);


        //4) Set User Role
        $user->attachRole($role);
    }
}
