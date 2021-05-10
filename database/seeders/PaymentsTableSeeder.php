<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 30; $i++) {
            Payment::create([
                'user_teacher_id' => 3,
                'user_student_id' => 2,
                'lesson_id' => 1,
                'status' => 1,
                'amount' => 100,
            ]);
        }
    }
}



