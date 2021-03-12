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
                'tel' => '00000000000',
                'password' => 'secret01',
                'account' => 'user1',
                'status' => 1,
                'is_teacher' => 1,
                'profile' => 'ユーザー1のプロフィール',
                'mailing' => '0',
            ],
            [
                'name' => 'ユーザー2',
                'email' => 'user2@example.com',
                'tel' => '00000000001',
                'password' => 'secret02',
                'account' => 'user2',
                'status' => 1,
                'is_teacher' => 1,
                'profile' => 'ユーザー2のプロフィール',
                'mailing' => '1',
            ],
            [
                'name' => 'ユーザー3',
                'email' => 'user3@example.com',
                'tel' => '00000000002',
                'password' => 'secret03',
                'account' => 'user3',
                'status' => 0,
                'is_teacher' => 0,
                'profile' => 'ユーザー3のプロフィール',
                'mailing' => '0',
            ],
        ];

        foreach($datas as $data) {
            $manage = new User();
            $manage->name = $data['name'];
            $manage->email = $data['email'];
            $manage->tel = $data['tel'];
            $manage->password = Hash::make($data['password']);
            $manage->account = $data['account'];
            $manage->status = $data['status'];
            $manage->is_teacher = $data['is_teacher'];
            $manage->profile = $data['profile'];
            $manage->mailing = $data['mailing'];
            $manage->save();
        }
        // for ($i = 1; $i < 10; $i++) {
        //     User::create([
        //         'name' => 'ユーザー'.$i,
        //         'email' => 'user'.$i.'@example.com',
        //         'password' => 'secret'.$i,
        //         'account' => 'user'.$i,
        //         'status' => 0,
        //         'prefecture_id' => $i,
        //         'profile' => 'ユーザー'.$i.'のプロフィール',
        //         'mailing' => '0',
        //     ]);
        // }
        // for ($i = 11; $i < 20; $i++) {
        //     User::create([
        //         'name' => 'ユーザー'.$i,
        //         'email' => 'user'.$i.'@example.com',
        //         'password' => 'secret'.$i,
        //         'account' => 'user'.$i,
        //         'status' => 1,
        //         'prefecture_id' => $i,
        //         'profile' => 'ユーザー'.$i.'のプロフィール',
        //         'mailing' => '0',
        //     ]);
        // }
        // for ($i = 21; $i < 30; $i++) {
        //     User::create([
        //         'name' => 'ユーザー'.$i,
        //         'email' => 'user'.$i.'@example.com',
        //         'password' => 'secret'.$i,
        //         'account' => 'user'.$i,
        //         'status' => 2,
        //         'prefecture_id' => $i,
        //         'profile' => 'ユーザー'.$i.'のプロフィール',
        //         'mailing' => '0',
        //     ]);
        // }
    }

}
