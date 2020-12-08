<?php

namespace App\Models;

use app\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'detail',
        'category1_id',
        'category2_id',
        'category3_id',
        'category4_id',
        'category5_id',
        'img1',
        'img2',
        'img3',
        'img4',
        'img5',
    ];

    /**
     * カテゴリー名を取得
     * @return string
     */
    public function getCategoryNameAttribute()
    {
        if ($this['category1_id'] == null) {
            return "";
        } else {
            return Category::query()->find($this['category1_id'])['name'];
        }
    }

    /**
     * 指定ステータスのコース全件検索
     *
     * @param $users_id
     * @param $params
     * @int $status
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findByUsersId(int $users_id, int $status)
    {
        return self::query()
            ->select([
               'courses.*',
               'categories1.name as category1_name',
               'categories2.name as category2_name',
               'categories3.name as category3_name',
            ])
            ->join('users', 'courses.user_id', '=', 'users.id')
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->where('courses.user_id', $users_id)
//            ->where('lessons.status', $status)
            ->orderBy('courses.created_at', 'desc')
            ->paginate(Config::get('const.paginate.lesson'));
    }

}
