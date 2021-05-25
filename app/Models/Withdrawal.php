<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdrawal extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'bank_id',
        'amount',
        'fee',
        'verified_at',
    ];

    /**
     * 取引履歴を登録する
     *
     *
     * @return string
     */
    public function store($id, $userId)
    {
        // DB::table('withdrawals')->create([
        $withdrawal = new Withdrawal();
        $withdrawal::create([
            'user_id'   => $userId,
            'bank_id'   => $id,
            'amount'    => Session::get('holding_amount'),
            'fee'       => Session::get('fee'),
        ]);
    }
}
