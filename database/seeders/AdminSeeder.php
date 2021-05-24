<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class AdminSeeder
 *
 * @package Database\Seeders
 */
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin 1
        $admin = new User();

        $admin->name = 'Admin';
        $admin->email = 'admin@admin.ro';
        $admin->password = Hash::make('parola');
        $admin->role = User::ROLE_ADMIN;
        $admin->email_verified_at = now();

        $admin->save();

        // employee 1
        $admin = new User();

        $admin->name = 'User';
        $admin->email = 'user@user.ro';
        $admin->password = Hash::make('parola');
        $admin->role = User::ROLE_USER;
        $admin->email_verified_at = now();
        //$admin->cost_center_id = 1;

        $admin->save();

        // employee 2
        $admin = new User();

        $admin->name = 'User2';
        $admin->email = 'user2@user2.ro';
        $admin->password = Hash::make('parola');
        $admin->role = User::ROLE_USER;
        $admin->email_verified_at = now();
      //  $admin->cost_center_id = 2;

        $admin->save();


    }
}
