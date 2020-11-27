<?php

namespace Database\Seeders;

use App\Models\Manage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $init_manages = [
            [
                'name' => '管理者1',
                'email' => 'manage1@example.com',
                'password' => 'secret1',
            ],
            [
                'name' => '管理者2',
                'email' => 'manage2@example.com',
                'password' => 'secret2',
            ],
            [
                'name' => '管理者3',
                'email' => 'manage3@example.com',
                'password' => 'secret3',
            ],
        ];

        foreach($init_manages as $init_manage) {
            $manage = new Manage();
            $manage->name = $init_manage['name'];
            $manage->email = $init_manage['email'];
            $manage->password = Hash::make($init_manage['password']);
            $manage->save();
        }
    }
}
