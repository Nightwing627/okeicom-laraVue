<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
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
     * 日付を月日フォーマット
     *
     * @return string
     */
    public function getFormatedMdDateAttribute()
    {
        return $this->date->format("n月j日");
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
     * レッスンの講師プロフィール画像を取得
     *
     * @return string
     */
    public function getPublicPathUsersImgAttribute()
    {
        $user = new User();
        return $user->createProfilePublicPath($this->users_img);
    }

    /**
     * コース画像1の公開パスを取得
     * @return string
     */
    public function getPublicPathCourseImg1Attribute()
    {
        $course = new Course();
        return $course->createCoursePublicPath($this->courses_img1);
    }

    /**
     * 講師の評価値を少数第一までにフォーマット
     * @return string
     */
    public function getRoundAvgPointAttribute()
    {
        // return $this->hasMany('App\Models\Evaluation');
        return round($this->evaluations_avg_point, 1);
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
    public function search()
    {
        // 講師ID（user_teacher_id）毎の平均値（points）を取得
        // $rating_avg = Evaluation::selectRaw('user_teacher_id, ROUND(AVG(point), 1) as point_avg')->groupBy('user_teacher_id')->get();

        $user = new User();
        $evaluations = $user->getTeachersPointQuery();
        // // ユーザー（講師）一覧を取得
        // $lessons = Lesson::all();
        // // ユーザーごとの評価を入れる配列を

        // $data = [];
        // // ユーザーごとの評価を配列に入れ直す
        // foreach ($lessons as $lesson) {
        //     $data[] = $lesson->hasMany('App\Models\Evaluation', 'user_teacher_id', 'id')->select('point')->get()->toArray();
        // };

        // // 配列の階層を1つ浅くする
        // for($i = 0; $i < count($lessons); $i++) {
        //     $points[] = [];
        //     for($t = 0; $t < count($data[$i]); $t++) {
        //         $points[$i][] += $data[$i][$t]['point'];
        //     }
        // }
        // // 配列ごとに足して、小数点2桁に変更
        // $avg = [];
        // for($i = 0; $i < count($points); $i++) {
        //     $avg[$i] = array_sum($points[$i]);
        //     if(!empty($avg[$i])) {
        //         $avg[$i] = (floor($avg[$i] / count($points[$i]) * 10) / 10);
        //     }
        // };

        return self::query()
            ->select([
                'lessons.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories4.name as category4_name',
                'categories5.name as category5_name',
                'users.img as user_img',
                'courses.img1 as course_img',
                'evaluations.avg_point as evaluations_avg_point',
                // 'PointAvg as user_point'
            ])
            // 今日の日付以降のレッスンを取得
            ->where('date', '>=', date("Y-m-d"))
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            // ->join('evaluations', 'lessons.user_id', '=', 'evaluations.user_teacher_id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'courses.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'courses.category5_id', '=', 'categories5.id');
            // ->orderBy('lessons.created_at', 'desc')
            // ->paginate(Config::get('const.paginate.lesson'));
    }

    // 受け取った値の処理はモデル
    // "scope"は「こいつはクエリスコープだよ」と宣言しているだけ、呼び出すときは不要
    public function scopeDynamicOrderBy($query, $params)
    {
        // asc・・・昇順（小さいもの順）
        // desc・・・降順（大きいもの順）
        if($params == 'newDate') {
            // 新着順
            return $query->orderby('lessons.created_at', 'asc');
        } elseif($params == 'dateLate') {
            // 開催日が近い順
            return $query->orderby('lessons.date', 'desc');
        } elseif($params == 'participantHigh') {
            // 参加者が多い順
            return $query->orderby('lessons.created_at', 'desc');
        } elseif($params == 'evaluationHigh') {
            // 評価が高い順
            return $query->orderby('lessons.created_at', 'desc');
        } elseif($params == 'priceLow') {
            // 料金が安い順
            return $query->orderby('lessons.price', 'asc');
        } else {
            // その他
            return $query->orderby('lessons.created_at', 'desc');
        };
        // ->paginate(Config::get('const.paginate.lesson'));




            // if($params =)
            // ->orderBy('lessons.created_at', 'desc');
    //     return $query->orderby($params);
    //     // return self::query()
    //     //     ->orderBy('lessons.created_at', 'desc')
    //     //     ->paginate(Config::get('const.paginate.lesson'));
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
                'categories4.name as category4_name',
                'categories5.name as category5_name',
                'users.img as user_img',
            ])
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'courses.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'courses.category5_id', '=', 'categories5.id')
            ->when($categories_id > 0, function ($query) use ($categories_id) {
                $query->where(function ($query) use ($categories_id) {
                    $query->orwhere('courses.category1_id', $categories_id)
                        ->orwhere('courses.category2_id', $categories_id)
                        ->orwhere('courses.category3_id', $categories_id)
                        ->orwhere('courses.category4_id', $categories_id)
                        ->orwhere('courses.category5_id', $categories_id);
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

    /**
     * ログインユーザの受講レッスン一覧取得
     *
     * @param $applications_status
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findByAuthUsersId(int $applications_status)
    {
        return self::query()
            ->select([
                'lessons.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories4.name as category4_name',
                'categories5.name as category5_name',
                'users.img as user_img',
            ])
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('applications', 'lessons.id', '=', 'applications.lesson_id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'courses.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'courses.category5_id', '=', 'categories5.id')
            ->where('applications.user_id', Auth::user()->id)
            ->where('applications.status', $applications_status)
            ->orderBy($applications_status == 1 ? 'applications.created_at' : 'lessons.created_at', 'desc')
            ->paginate(Config::get('const.paginate.attendanceLesson'));
    }

    /**
     * 指定コースのレッスンを削除
     *
     * @param int $courses_id
     * @return mixed
     */
    public function deleteByCoursesId(int $courses_id) {
        return self::query()->where('course_id', $courses_id)->delete();
    }

    /**
     * 指定ユーザのレッスン一覧取得。参加者人数を取得
     *
     * @param int $users_id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findByUsersIdGetApplicationCnt(int $users_id)
    {
        // レッスン別に参加人数を取得
        $applications = Application::query()
            ->select(
                'applications.lesson_id',
                DB::raw('count(*) as count')
            )
            ->join('lessons', 'applications.lesson_id', '=', 'lessons.id')
            ->where('lessons.user_id', $users_id)
            ->groupBy('applications.lesson_id');

        return self::query()
            ->select([
                'lessons.*',
                'applications.count as application_cnt'
            ])
            ->joinSub($applications, 'applications', function ($join) {
                $join->on('lessons.id', '=', 'applications.lesson_id');
            })
            ->where('lessons.user_id', $users_id)
            ->orderBy('lessons.date', 'desc')
            ->get();
    }

    /**
     * 退会によるレッスン状態の更新
     */
    public function updateStatusByWithdraw() {
        self::query()
            ->where('lessons.user_id', Auth::user()->id)
            ->where('lessons.status', self::STATUS_PLANS)
            ->update([
                'lessons.status' => self::STATUS_CANCEL_TEACHER
            ]);
    }

    /**
     * 本日のレッスンを取得
     *
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getTodays()
    {
        // 講師別の評価値を集計
        $user = new User();
        $evaluations = $user->getTeachersPointQuery();

        return self::query()
            ->select([
                'lessons.*',
                'courses.img1 as courses_img1',
                'courses.img2 as courses_img2',
                'courses.img3 as courses_img3',
                'courses.img4 as courses_img4',
                'courses.img5 as courses_img5',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories2.name as category4_name',
                'categories3.name as category5_name',
                'users.img as users_img',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'courses.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'courses.category5_id', '=', 'categories5.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
            ->whereDate('lessons.date', Carbon::now()->toDateString())
            ->orderBy('lessons.start')
            ->orderBy('lessons.finish')
            ->orderBy('lessons.created_at')
            ->limit(Config::get('const.top_thumbnail_count'))
            ->get();
    }

    /**
     * 人気のレッスンを取得
     *
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPopular()
    {
        // 講師別の評価値を集計
        $user = new User();
        $evaluations = $user->getTeachersPointQuery();

        // レッスン別に参加人数を取得
        $applications = Application::query()
            ->select(
                'applications.lesson_id',
                DB::raw('count(*) as count')
            )
            ->join('lessons', 'applications.lesson_id', '=', 'lessons.id')
            ->groupBy('applications.lesson_id');

        return self::query()
            ->select([
                'lessons.*',
                'courses.img1 as courses_img1',
                'courses.img2 as courses_img2',
                'courses.img3 as courses_img3',
                'courses.img4 as courses_img4',
                'courses.img5 as courses_img5',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories2.name as category4_name',
                'categories3.name as category5_name',
                'users.img as users_img',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->leftJoinSub($applications, 'applications', function ($join) {
                $join->on('lessons.id', '=', 'applications.lesson_id');
            })
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'courses.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'courses.category5_id', '=', 'categories5.id')
            ->where('lessons.status', self::STATUS_PLANS)
            ->orderBy('applications.count', 'desc')
            ->orderBy('lessons.created_at')
            ->limit(Config::get('const.top_thumbnail_count'))
            ->get();
    }

    /**
     * 高評価のレッスンを取得
     *
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getHighlyRated()
    {
        // 講師別の評価値を集計
        $user = new User();
        $evaluations = $user->getTeachersPointQuery();

        return self::query()
            ->select([
                'lessons.*',
                'courses.img1 as courses_img1',
                'courses.img2 as courses_img2',
                'courses.img3 as courses_img3',
                'courses.img4 as courses_img4',
                'courses.img5 as courses_img5',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories2.name as category4_name',
                'categories3.name as category5_name',
                'users.img as users_img',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('lessons.user_id', '=', 'evaluations.user_teacher_id');
            })
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'courses.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'courses.category5_id', '=', 'categories5.id')
            ->where('lessons.status', self::STATUS_PLANS)
            ->orderBy('evaluations.avg_point', 'desc')
            ->orderBy('lessons.created_at')
            ->limit(Config::get('const.top_thumbnail_count'))
            ->get();
    }

    /**
     * 新着レッスンを取得
     *
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getNewArrival()
    {
        // 講師別の評価値を集計
        $user = new User();
        $evaluations = $user->getTeachersPointQuery();

        return self::query()
            ->select([
                'lessons.*',
                'courses.img1 as courses_img1',
                'courses.img2 as courses_img2',
                'courses.img3 as courses_img3',
                'courses.img4 as courses_img4',
                'courses.img5 as courses_img5',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories2.name as category4_name',
                'categories3.name as category5_name',
                'users.img as users_img',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'courses.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'courses.category5_id', '=', 'categories5.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('lessons.user_id', '=', 'evaluations.user_teacher_id');
            })
            ->where('lessons.status', self::STATUS_PLANS)
            ->orderBy('lessons.created_at', 'desc')
            ->limit(Config::get('const.top_thumbnail_count'))
            ->get();
    }
}
