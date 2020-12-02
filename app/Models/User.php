<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const STATUS_STUDENT = 0;
    const STATUS_TEACHER = 1;
    const SEX_UNKNOWN = 0;
    const SEX_MALE = 1;
    const SEX_FEMALE = 2;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account',
        'status',
        'sex',
        'age',
        'country_id',
        'prefecture_id',
        'language_id',
        'img',
        'profile',
        'mailing',
        'bank_type',
        'bank_id',
        'credit_id',
        'category1_id',
        'category2_id',
        'category3_id',
        'category4_id',
        'category5_id',
        'withdraw_reason',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 日付を変形する属性
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * 現在の状態名称リストを連想配列で取得
     *
     * @return array
     */
    public static function getArrayStatuses()
    {
        return [
            self::STATUS_STUDENT => __('UserStatusStudent'),
            self::STATUS_TEACHER => __('UserStatusTeacher'),
        ];
    }

    /**
     * 性別の名称リストを連想配列で取得
     *
     * @return array
     */
    public static function getArraySexes()
    {
        return [
            self::SEX_UNKNOWN => __('UserSexUnknown'),
            self::SEX_MALE => __('UserSexMale'),
            self::SEX_FEMALE => __('UserSexFemale'),
        ];
    }
}
