<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdrawal extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'bank_type',
        'bank_id',
        'amount',
        'verified',
    ];

    /**
     * 取引履歴を登録する
     *
     *
     * @return string
     */
    public function store($params, $user_id, $id)
    {
        // DB::table('withdrawals')->create([
        $withdrawal = new Withdrawal();
        $withdrawal::create([
            'user_id'   => $user_id,
            'bank_type' => $params->bank_type,
            'bank_id'   => $id,
            'amount'    => $params->amount,
        ]);
    }
}
