<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_teacher_id',
        'user_student_id',
        'amount',
    ];

    /**
     * 保有金額をカンマ区切りにフォーマット
     *
     * @return string
     */
    public function getSeparateCommaAmountAttribute()
    {
        return '¥' . number_format($this->amount);
    }

    /**
     * 時点保有金額をカンマ区切りにフォーマット
     *
     * @return string
     */
    public function getSeparateCommaPointAmountAttribute()
    {
        return '¥' . number_format($this->point_amount);
    }

    /**
     * 決済金額を符号付きカンマ区切りにフォーマット
     *
     * @return string
     */
    public function getSeparateCommaPointAddSignAmountAttribute()
    {
        $sign = $this->add_sign_amount >= 0 ? '+' : '-';
        return $sign . '¥' . number_format(abs($this->add_sign_amount));
    }

    /**
     * 取引年月日をフォーマット
     *
     * @return string
     */
    public function getFormatedYmdCreatedAtAttribute()
    {
        return $this->created_at->format("Y年n月j日");
    }

    /**
     * 保有金額を取得
     *
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getHoldingAmount()
    {
        // プラス金額(レッスンを購入された履歴)を取得
        $user_id = Auth::user()->id;
        $query_plus_amount = self::query()
            ->select([
                DB::raw('1 as id'),
                DB::raw('sum(amount) as sum_amount')
            ])
            ->where('payments.user_teacher_id', $user_id)
            ->groupBy([
                'payments.id',
            ]);

        // マイナス金額(レッスンを購入したor出金した履歴)とプラス金額をUNION ALLで取得
        $query_amount = self::query()
            ->select([
                DB::raw('max(payments.id) as id'),
                DB::raw('sum(amount) * -1 as sum_amount')
            ])
            ->where('payments.user_student_id', $user_id)
            ->groupBy([
                'payments.id',
            ])
            ->unionAll($query_plus_amount);

        //

        // 総保有金額を取得
        return self::query()
            ->select([
                DB::raw('sum(amounts.sum_amount) as amount')
            ])
            ->joinSub($query_amount, 'amounts', function ($join) {
                $join->on('payments.id', '=', 'amounts.id');
            })
            ->first();
    }

    /**
     * 取引月を取得
     *
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getMonths()
    {
        return self::query()
            ->select([
                DB::raw("CONCAT(DATE_FORMAT(payments.created_at, '%Y%m'), '01') as months")
            ])
            ->orWhere('payments.user_teacher_id', Auth::user()->id)
            ->orWhere('payments.user_student_id', Auth::user()->id)
            ->groupByRaw(
                "CONCAT(DATE_FORMAT(payments.created_at, '%Y%m'), '01')",
            )
            ->orderByRaw('1 desc')
            ->get();
    }

    /**
     * 取引詳細を取得
     *
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getDetail()
    {
        $details = self::query()
            ->select([
                'payments.*',
                'lessons.title as lessons_title'
            ])
            ->leftJoin('applications', 'payments.application_id', '=', 'applications.id')
            ->leftJoin('lessons', 'applications.lesson_id', '=', 'lessons.id')
            ->where(function ($query) {
                $query->orWhere('payments.user_teacher_id', Auth::user()->id)
                      ->orWhere('payments.user_student_id', Auth::user()->id);
            })
            ->orderBy('payments.created_at')
            ->get();

        $wk_point_amount = 0;
        foreach ($details as $detail) {
            // 取引時点の保有金額情報を付加
            $detail->point_amount = $wk_point_amount;
            // 先生なら＋、生徒ならー
            $detail->add_sign_amount = Auth::user()->id == $detail->user_teacher_id ? $detail->amount : $detail->amount * -1;
            $wk_point_amount += $detail->add_sign_amount;
        }

        return $details->reverse();
    }
}
