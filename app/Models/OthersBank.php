<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class OthersBank extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'financial_name',
        'branch_name',
        'branch_number',
        'type',
        'number',
        'name',
    ];

    /**
     * その他銀行情報を登録する
     *
     *
     * @return string
     */
    public function registerOtherbank($params, $id)
    {
        // dd('その他だよ！');
        // DB::table('others_banks')->create([
        $others_bank = new OthersBank();
        $others_bank::create([
            'user_id'           => $id,
            'financial_name'    => $params->other_financial_name,
            'branch_name'       => $params->other_branch_name,
            'branch_number'     => $params->other_branch_number,
            'type'              => $params->other_type,
            'number'            => $params->other_number,
            'name'              => $params->other_name,
        ]);
    }
}
