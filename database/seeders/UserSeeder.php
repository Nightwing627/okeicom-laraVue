<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->truncate();

        $datas = [
            [
                'name' => 'ユーザー1',
                'email' => 'user1@example.com',
                'password' => 'secret01',
                'account' => 'user1',
                'status' => 0,
                'profile' => 'ユーザー1のプロフィール',
                'mailing' => '0',
            ],
            [
                'name' => 'ユーザー2',
                'email' => 'user2@example.com',
                'password' => 'secret02',
                'account' => 'user2',
                'status' => 0,
                'profile' => 'ユーザー2のプロフィール',
                'mailing' => '1',
            ],
            [
                'name' => 'ユーザー3',
                'email' => 'user3@example.com',
                'password' => 'secret03',
                'account' => 'user3',
                'status' => 1,
                'profile' => 'ユーザー3のプロフィール',
                'mailing' => '0',
            ],
        ];

        foreach($datas as $data) {
            $manage = new User();
            $manage->name = $data['name'];
            $manage->email = $data['email'];
            $manage->password = Hash::make($data['password']);
            $manage->account = $data['account'];
            $manage->status = $data['status'];
            $manage->profile = $data['profile'];
            $manage->mailing = $data['mailing'];
            $manage->save();
        }
    }
}
