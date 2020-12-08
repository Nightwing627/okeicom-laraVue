<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_NORMAL = 0;            // 正常
    const STATUS_COMPLETION = 1;        // 終了済み
    const STATUS_CANCEL_STUDENT = 2;    // 生徒キャンセル（退会時も）
    const STATUS_CANCEL_TEACHER = 3;    // 講師キャンセル（退会時も）
    const STATUS_CANCEL_ADMIN = 3;      // 運営キャンセル

}
