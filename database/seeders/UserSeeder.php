<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $init_users = [
            [
                'name' => 'ユーザー1',
                'email' => 'user1@example.com',
                'password' => 'secret1',
                'account' => 'user1',
                'status' => 0,
                'profile' => 'ユーザー1のプロフィール',
                'mailing' => '0',
            ],
            [
                'name' => 'ユーザー2',
                'email' => 'user2@example.com',
                'password' => 'secret2',
                'account' => 'user2',
                'status' => 0,
                'profile' => 'ユーザー2のプロフィール',
                'mailing' => '1',
            ],
            [
                'name' => 'ユーザー3',
                'email' => 'user3@example.com',
                'password' => 'secret3',
                'account' => 'user3',
                'status' => 1,
                'profile' => 'ユーザー3のプロフィール',
                'mailing' => '0',
            ],
        ];

        foreach($init_users as $init_user) {
            $manage = new User();
            $manage->name = $init_user['name'];
            $manage->email = $init_user['email'];
            $manage->password = Hash::make($init_user['password']);
            $manage->account = $init_user['account'];
            $manage->status = $init_user['status'];
            $manage->profile = $init_user['profile'];
            $manage->mailing = $init_user['mailing'];
            $manage->save();
        }
    }
}
