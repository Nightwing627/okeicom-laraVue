<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cancel extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_AUTO = 0;              // 24時間以前のキャンセル
    const STATUS_PENDING_TEACHER = 1;   // 講師承認待ち
    const STATUS_PENDING_ADMIN = 2;     // 運営承認待ち
    const STATUS_APPROVAL = 3;          // 承認済み
    const STATUS_DENIAL_TEACHER = 8;    // 講師非承認
    const STATUS_DENIAL_ADMIN = 9;      // 運営非承認

    /**
     * キャンセル申請中の件数を取得
     *
     * @param int $users_id
     * @return int
     */
    public function getCancelPendingCount(int $users_id)
    {
        return self::query()
            ->join('applications', 'cancels.application_id', '=', 'applications.id')
            ->join('lessons', 'applications.lesson_id', '=', 'lessons.id')
            ->where('lessons.user_id', $users_id)
            ->where('applications.status', Application::STATUS_NORMAL)
            ->whereIn('cancels.status', [self::STATUS_PENDING_TEACHER, self::STATUS_PENDING_ADMIN])
            ->count();
    }
}
