<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Withdraw extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'reason',
    ];

    /**
     * 退会処理
     */
    public function executeWithdraw() {
        // 退会作成
        $withdraw = new self();
        $withdraw->fill([
            'user_id' => Auth::user()->id,
        ])->save();

        // 申込、自身の開始前レッスンの申込があればキャンセルに
        $application = new Application();
        $application->updateStatusByWithdraw();

        // 自身の予定済みレッスンがあればキャンセルに
        $lesson = new Lesson();
        $lesson->updateStatusByWithdraw();

        // ログインユーザを削除
        $user = new User();
        $user->deleteLoggedUser();
    }
}
