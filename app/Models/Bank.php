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
        return Bank::find($id)
            ->leftJoin('bank_japans', 'banks.id', 'bank_japans.bank_id')
            ->leftJoin('bank_others', 'banks.id', 'bank_others.bank_id')
            ->get();
    };
}
