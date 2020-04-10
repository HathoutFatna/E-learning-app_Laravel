<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$5bw8eH8uCy3o4Hj8OO6qd.70SonZXmko/TK5cayxMR7OVIqSihhtu',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
