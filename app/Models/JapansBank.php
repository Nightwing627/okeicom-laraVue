<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class JapansBank extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'mark',
        'number',
        'name',
    ];

    /**
     * その他銀行情報を登録する
     *
     *
     * @return string
     */
    public function registerJapanBank($params, $id)
    {
        $japans_bank = new JapansBank();
        $japans_bank::create([
            'user_id'   => $id,
            'mark'      => $params->yucho_mark,
            'number'    => $params->yucho_number,
            'name'      => $params->yucho_name,
        ]);
    }
}
