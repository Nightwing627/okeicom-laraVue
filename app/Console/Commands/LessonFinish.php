<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Lesson;
use App\Models\Payment;
use App\Models\Application;
use Illuminate\Console\Command;

class LessonFinish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //コマンドの名前を設定
    protected $signature = 'lesson:finish';

    /**
     * The console command description.
     *
     * @var string
     */
    //バッチの説明をここに書く
    protected $description = 'レッスンの終了時間に合わせて、レッスンを終了させる';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // レッスンの終了時刻を超えた場合、論理削除処理実装
        $lessons = Lesson::where('date', '=', Carbon::today())
            ->where('finish', '<=', Carbon::now())
            ->get();
        foreach($lessons as $lesson) {
            $lesson_id = $lesson->id;
            // レッスンと紐づく予約情報を取得し、論理削除を実行
            $applications = Application::where('lesson_id', '=', $lesson_id)->where('status', '=', 0)->get();
            if($applications) {
                foreach($applications as $application) {
                    // 予約情報を確定し、ステータスを1に変更
                    $application->status = 1;
                    $application->delete();
                    $application->save();

                    // // 予約情報ごとに、決済履歴情報を登録
                    // $payment = new Payment();
                    // /* 講師IDを取得 */
                    // // レッスンIDを取得
                    // $lesson_id = $application->lesson_id;
                    // // レッスンIDから、レッスン情報を取得
                    // $lessonInstance = new Lesson();
                    // // レッスン情報から講師IDを取得する
                    // $teacher_id = $lessonInstance::find($lesson_id)->user_id;

                    // /* 受講者IDを取得 */
                    // $student_id = $application->user_id;

                    // /* 受講金額 */
                    // $price = $application->price;

                    // /* 決済登録処理 */
                    // $payment->user_teacher_id = $teacher_id;
                    // $payment->user_student_id = $student_id;
                    // $payment->lesson_id       = $lesson_id;
                    // $payment->amount          = $price;
                    // $payment->save();

                    /* 決済情報を変更する */
                    $payments = Payment::where('lesson_id', '=', $application->lesson_id)->get();
                    if($payments) {
                        foreach($payments as $payment) {
                            $payment->status = 1;
                            $payment->save();
                        }
                    }

                    /* 予約を論理削除 */
                    $application->delete();
                    $application->save();
                }
            }
            // レッスンを論理削除
            $lesson->delete();
            $lesson->save();

        }
    }
}
