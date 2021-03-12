<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->truncate();

        // $datas = [
        //     [
        //         'user_id' => 1,
        //         'course_id' => 1,
        //         'status' => 0,
        //         'public' => 0,
        //         'type' => 0,
        //         'date' => '2021-01-01',
        //         'start' => '15:25',
        //         'finish' => '17:00',
        //         'price' => '0',
        //         'cancel_rate' => '0',
        //         'title' => 'レッスン1-1',
        //         'detail' => 'レッスン1-1の詳細',
        //     ],
        //     [
        //         'user_id' => 1,
        //         'course_id' => 1,
        //         'status' => 0,
        //         'public' => 0,
        //         'type' => 0,
        //         'date' => '2021-01-02',
        //         'start' => '09:00',
        //         'finish' => '10:30',
        //         'price' => '10000',
        //         'cancel_rate' => '10',
        //         'title' => 'レッスン1-2',
        //         'detail' => 'レッスン1-2の詳細',
        //     ],
        //     [
        //         'user_id' => 1,
        //         'course_id' => 1,
        //         'status' => 0,
        //         'public' => 0,
        //         'type' => 0,
        //         'date' => '2021-01-03',
        //         'start' => '20:00',
        //         'finish' => '23:59',
        //         'price' => '15000',
        //         'cancel_rate' => '15',
        //         'title' => 'レッスン1-3',
        //         'detail' => 'レッスン1-3の詳細',
        //     ],
        //     [
        //         'user_id' => 1,
        //         'course_id' => 2,
        //         'status' => 1,
        //         'public' => 0,
        //         'type' => 0,
        //         'date' => '2020-12-20',
        //         'start' => '09:00',
        //         'finish' => '18:00',
        //         'price' => '200000',
        //         'cancel_rate' => '50',
        //         'title' => '全1回のレッスン',
        //         'detail' => '全1回のレッスン詳細',
        //     ],
        // ];
        // foreach($datas as $data) {
        //     $lesson = new Lesson();
        //     $lesson->user_id = $data['user_id'];
        //     $lesson->course_id = $data['course_id'];
        //     $lesson->status = $data['status'];
        //     $lesson->public = $data['public'];
        //     $lesson->type = $data['type'];
        //     $lesson->date = $data['date'];
        //     $lesson->start = $data['start'];
        //     $lesson->finish = $data['finish'];
        //     $lesson->price = $data['price'];
        //     $lesson->cancel_rate = $data['cancel_rate'];
        //     $lesson->title = $data['title'];
        //     $lesson->detail = $data['detail'];
        //     $lesson->save();
        // }

        for ($i = 1; $i < 20; $i++) {
            Lesson::create([
                'user_id' => 1,
                'course_id' => 1,
                'status' => 0,
                'public' => 1,
                'type' => 1,
                'view' => 'nQizZ9J7KmDsgSVeWKgM63ZFkDK795KcnQizZ9J7KmDsgSVeWKgM63ZFkDK795Kc',
                'date' => '2021-02-'.$i,
                'start' => '00:00',
                'finish' => '00:00',
                'price' => $i * 100,
                'cancel_rate' => '5',
                'title' => 'ユーザ２のレッスンナンバー'.$i,
                'detail' => 'ユーザ２のレッスン詳細ナンバー'.$i,
            ]);
        }

        for ($i = 1; $i < 16; $i++) {
            Lesson::create([
                'user_id' => 1,
                'course_id' => 2,
                'status' => 0,
                'public' => 1,
                'type' => 1,
                'view' => 'nCw7dCCn3Fs5gJcAyWwDeh3PDZFYaegRnCw7dCCn3Fs5gJcAyWwDeh3PDZFYaegR',
                'date' => '2021-02-'.$i,
                'start' => '00:00',
                'finish' => '00:00',
                'price' => $i * 100,
                'cancel_rate' => '5',
                'title' => 'ユーザ3のレッスンナンバー'.$i,
                'detail' => 'ユーザ3のレッスン詳細ナンバー'.$i,
            ]);
        }
    }
}
