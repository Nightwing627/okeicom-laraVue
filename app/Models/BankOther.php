<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankOther extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'financial_name',
        'branch_name',
        'branch_number',
        'type',
    ];
}
