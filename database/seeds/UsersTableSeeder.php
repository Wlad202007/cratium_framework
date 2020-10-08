<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2020-10-07 21:16:53',
                'academic_status'    => '',
                'position'           => '',
                'phone'              => '',
                'verification_token' => '',
                'last_name'          => '',
                'middle_name'        => '',
            ],
        ];

        User::insert($users);
    }
}
