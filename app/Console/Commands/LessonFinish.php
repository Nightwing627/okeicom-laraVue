<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Lesson;
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
            // レッスンと紐づく予約情報を取得
            $application = new Application();
            $applications = $application::where('id', '=', $lesson_id)->where('status', '=', 0)->get();
            if($applications) {
                foreach($applications as $application) {
                    // 予約を論理削除
                    $application->delete();
                    $application->save();
                }
            }
            // レッスンを論理削除
            $lesson->delete();
            $lesson->save();

            // 決済確定処理
        }
    }
}
