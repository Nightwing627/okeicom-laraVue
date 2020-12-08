<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_PLANS = 0;             // 予定済み
    const STATUS_FINISHED = 1;          // 終了済み
    const STATUS_CANCEL_TEACHER = 2;    // 講師キャンセル
    const STATUS_CANCEL_ADMIN = 3;      // 運営キャンセル
    const TYPE_LIVE = 0;
    const TYPE_MOVIE = 1;
    const TYPE_DOCUMENT = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'number',
        'public',
        'type',
        'youtube',
        'slide',
        'date',
        'start',
        'finish',
        'price',
        'cancel_rate',
        'title',
        'detail',
    ];

    /**
     * 日付を変形する属性
     *
     * @var array
     */
    protected $dates = [
        'date',
        'start',
        'finish',
    ];

    /**
     * レッスン番号を漢字にフォーマット
     *
     * @return string
     */
    public function getKanjiNumberAttribute()
    {
        $kanji_number = ['〇','一','二','三','四','五','六','七','八','九'];
        $formattedNumber = '';
        foreach(str_split($this->number) as $value){
            $formattedNumber .= $kanji_number[(int)$value];
        }
        return "第{$formattedNumber}回";
    }

    /**
     * 日付を西暦ハイフン区切り時刻なしにフォーマット
     *
     * @return string
     */
    public function getSeparateHyphenDateAttribute()
    {
        return $this->date->format("Y-m-d");
    }

    /**
     * 日付に曜日を付加するフォーマット
     *
     * @return string
     */
    public function getAddWeekDateAttribute()
    {
        $week = ['日', '月', '火', '水', '木', '金', '土'];
        return $this->date->format("n/j") . "({$week[$this->date->format("w")]})";
    }

    /**
     * 時刻の開始終了をハイフン区切りにフォーマット
     *
     * @return string
     */
    public function getSeparateHyphenTimeAttribute()
    {
        return $this->start->format("H:i") . '-' . $this->finish->format("H:i");
    }

    /**
     * 金額をカンマ区切りにフォーマット
     *
     * @return string
     */
    public function getSeparateCommaPriceAttribute()
    {
        return '¥' . number_format($this->price);
    }

    /**
     * タイプの名称リストを連想配列で取得
     *
     * @return array
     */
    public static function getArrayTypes()
    {
        return [
            self::TYPE_LIVE => __('LessonTypeLive'),
            self::TYPE_MOVIE => __('LessonTypeMovie'),
            self::TYPE_DOCUMENT => __('LessonTypeDocument'),
        ];
    }

    /**
     * 全件検索
     *
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(array $params)
    {
        return self::query()
            ->select([
                'lessons.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'users.img as user_img',
            ])
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->orderBy('lessons.created_at', 'desc')
            ->paginate(Config::get('const.paginate.lesson'));
    }

    /**
     * 指定カテゴリのレッスン取得
     *
     * @param int $categories_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findByCategoriesId($categories_id = 0)
    {
        return self::query()
            ->select([
                'lessons.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'users.img as user_img',
            ])
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->when($categories_id > 0, function ($query) use ($categories_id) {
                $query->where(function ($query) use ($categories_id) {
                    $query->orwhere('courses.category1_id', $categories_id)
                          ->orwhere('courses.category2_id', $categories_id)
                          ->orwhere('courses.category3_id', $categories_id);
                });
            })
            ->orderBy('lessons.created_at', 'desc')
            ->paginate(Config::get('const.paginate.lesson'));
    }

    /**
     * 指定コースのレッスン一覧取得
     *
     * @param int $courses_id
     * @param int $users_id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findByCoursesId(int $courses_id, int $users_id)
    {
        return self::query()
            ->where('lessons.user_id', $users_id)
            ->where('lessons.course_id', $courses_id)
            ->orderBy('lessons.number')
            ->get();
    }
}