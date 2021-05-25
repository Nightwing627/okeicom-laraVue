<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'number',
        'name',
    ];

    public function showBank($id)
    {
        return Bank::select([
                'banks.*',
                'bank_japans.mark as japan_mark',
                'bank_others.financial_name as other_name',
                'bank_others.branch_number as other_number',
                'bank_others.type as other_type',
            ])
            ->where('user_id', $id)
            ->where('deleted_at', null)
            ->leftJoin('bank_japans', 'banks.id', 'bank_japans.bank_id')
            ->leftJoin('bank_others', 'banks.id', 'bank_others.bank_id')
            ->first();
    }
}
