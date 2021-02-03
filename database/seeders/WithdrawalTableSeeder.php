<?php

namespace Database\Seeders;

use App\Models\Withdrawal;
use Illuminate\Database\Seeder;

class WithdrawalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Withdrawal::create([
            'user_id'   => 1,
            'bank_type' => 0,
            'bank_id'   => 1,
            'amount'    => 30000,
            'verified'  => null,
        ]);
    }
}
