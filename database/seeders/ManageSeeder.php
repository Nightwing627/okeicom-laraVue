<?php

namespace Database\Seeders;

use App\Models\Manage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manages')->truncate();

        $datas = [
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

        foreach($datas as $data) {
            $manage = new Manage();
            $manage->name = $data['name'];
            $manage->email = $data['email'];
            $manage->password = Hash::make($data['password']);
            $manage->save();
        }
    }
}
