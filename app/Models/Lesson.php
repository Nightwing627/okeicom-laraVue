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

    const STATUS_PLANS = 0;             // 予約済み
    const STATUS_FINISHED = 1;          // 終了済み
    const STATUS_CANCEL = 2;            // キャンセル済み
    const TYPE_LIVE = 0;                // LIVE
    const TYPE_MOVIE = 1;               // MOVIE
    const TYPE_DOCUMENT = 2;            // PDF（ドキュメント）

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

    /* Base / get~~~Index, get~~~Show, get~~~Delete, get~~~Update
    --------------------------------------------------------------------------------------------------*/
    /**
     * レッスン一覧（キーワード検索 / 日付検索 / カテゴリー検索）
     *
     * @param int $categories_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findBySearchKeyword($params, $categories_id = 0)
    {
        // ユーザー一覧
        $user = new User();
        $evaluations = $user->getTeachersPointQuery();

        // キーワード

        return self::query()
            ->select([
                'lessons.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories4.name as category4_name',
                'categories5.name as category5_name',
                'users.img as user_img',
                'evaluations.avg_point as evaluations_avg_point',
            ])

            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
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
            // [条件指定] 今日の日付以降のレッスンを取得
            ->where(function($query){
                $query->orWhere('lessons.date', '>=', date("Y-m-d"));
            })
            // [条件指定] 選択した日付のレッスンを表示
            ->when(isset($params['select_date']), function($query) use ($params) {
                $query->where(function ($query) use ($params) {
                    $query->orwhere('lessons.date', '=', $params['select_date']);
                });
            })

            // [条件指定] 入力したキーワードから検索
            ->when(isset($params['keyword']), function($query) use ($params) {
                $query->where(function ($query) use ($params) {
                    $query->orwhere('lessons.title', 'like', '%'.$params['keyword'].'%')
                        ->orWhere('lessons.detail','like','%'.$params['keyword'].'%');
                });
            });
            // ->orderBy('lessons.created_at', 'desc')
            // ->paginate(Config::get('const.paginate.lesson'));
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
        $user = new User();
        $evaluations = $user->getTeachersPointQuery();

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
            ])
            // 今日の日付以降のレッスンを取得
            ->where('date', '>=', date("Y-m-d"))
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
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

    /**
     * 指定カテゴリのレッスン取得
     *
     * @param int $categories_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function findByCategoriesId($params)
    {
        $categories_id = $params['categories_id'];
        $user = new User();
        $evaluations = $user->getTeachersPointQuery();
        return self::query()
            ->select([
                'lessons.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories4.name as category4_name',
                'categories5.name as category5_name',
                'users.img as user_img',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            // 今日の日付以降のレッスンを取得
            ->where('date', '>=', date("Y-m-d"))
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
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
            });
    }

    /**
     * 指定コースのレッスン数を取得
     *
     * @param int $courses_id
     * @param int $users_id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    // public function findByCourseLessonCounts()
    // {
    //     // 1.IDごとのレッスンを取得（集計関数 count）
    //     return self::query()
    //         ->select(
    //             'lessons.course_id',
    //             DB::raw('COUNT(lessons.course_id) AS course_counts'),
    //         )
    //         // 2.course idごとにgroup byする
    //         ->groupBy('lessons.course_id');
    // }

    /**
     * 指定コースのレッスン一覧取得
     *
     * @param int $courses_id
     * @param int $users_id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findByCoursesId(int $courses_id, int $users_id)
    {
        $user = new User();
        $evaluations = $user->getTeachersPointQuery();
        return self::query()
            ->where('lessons.user_id', $users_id)
            ->where('lessons.course_id', $courses_id)
            ->orderBy('lessons.number')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('lessons.user_id', '=', 'evaluations.user_teacher_id');
            })
            ->get();
    }

    /* Relationships / relate~~~
    --------------------------------------------------------------------------------------------------*/

    /* Query methods / getQuery~~~
    --------------------------------------------------------------------------------------------------*/


    /* Scope / scopeOf~~~
    --------------------------------------------------------------------------------------------------*/
    // スコープ：並び替え
    public function scopeDynamicOrderBy($query, $params)
    {
        // asc・・・昇順（小さいもの順）
        // desc・・・降順（大きいもの順）
        if(isset($params['sort_param']) === 'newDate') {
            // 新着順
            return $query->orderby('lessons.created_at', 'asc');
        } elseif(isset($params['sort_param']) === 'dateLate') {
            // 開催日が近い順
            return $query->orderby('lessons.date', 'asc');
        } elseif(isset($params['sort_param']) === 'participantHigh') {
            // 参加者が多い順
            return $query->orderby('lessons.created_at', 'desc');
        } elseif(isset($params['sort_param']) === 'evaluationHigh') {
            // 評価が高い順
            return $query->orderby('evaluations_avg_point', 'desc');
        } elseif(isset($params['sort_param']) === 'priceLow') {
            // 料金が安い順
            return $query->orderby('lessons.price', 'asc');
        } else {
            // その他
            return $query->orderby('lessons.created_at', 'desc');
        };
        // ->paginate(Config::get('const.paginate.lesson'));
    }

    /* Accessors and mutators / get~~~Attribute / ~~~
    --------------------------------------------------------------------------------------------------*/

    /* Other /
    --------------------------------------------------------------------------------------------------*/











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
     * 指定ユーザのレッスン一覧取得（＋参加者人数付き）
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
                'categories4.name as category4_name',
                'categories5.name as category5_name',
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
                'categories4.name as category4_name',
                'categories5.name as category5_name',
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

            ->where('lessons.date', '>=', date("Y-m-d"))
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
                'categories4.name as category4_name',
                'categories5.name as category5_name',
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
            ->where('lessons.date', '>=', date("Y-m-d"))
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
                'categories4.name as category4_name',
                'categories5.name as category5_name',
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
            ->where('lessons.date', '>=', date("Y-m-d"))
            ->orderBy('lessons.created_at', 'desc')
            ->limit(Config::get('const.top_thumbnail_count'))
            ->get();
    }

    /**
     * レッスン詳細
     *
     * @return
     */
    public function getShowLesson($id)
    {
        // 講師別の評価値を集計
        $user           = new User();
        $evaluations    = $user->getTeachersPointQuery();

        // レッスン別の申込数を取得
        $applicants     = $this->getLessonApplicationQuery();

        return self::query()
            // レッスン評価
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('lessons.user_id', '=', 'evaluations.user_teacher_id');
            })
            // レッスン参加者
            ->leftJoinSub($applicants, 'applications', function ($join) {
                $join->on('lessons.id', '=', 'applications.lesson_id');
            })
            ->join('courses', 'lessons.course_id', '=', 'courses.id')
            ->leftJoin('categories as categories1', 'courses.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'courses.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'courses.category3_id', '=', 'categories3.id')
            ->leftJoin('categories as categories4', 'courses.category4_id', '=', 'categories4.id')
            ->leftJoin('categories as categories5', 'courses.category5_id', '=', 'categories5.id')
            ->select([
                'lessons.*',
                'evaluations.avg_point AS evaluations_avg_point',
                'applications.applicants_number AS applicants_number',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'categories4.name as category4_name',
                'categories5.name as category5_name',
            ])
            ->where('lessons.id', '=', $id);
    }

    /* クエリ get~~~Query
    ------------------------------------------------------------------------------------------------------*/
    /**
     * レッスンの参加者数の合計クエリを取得
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getLessonApplicationQuery()
    {
        // レッスン別の申込数を集計
        return Application::query()
            // lesson_idごとに、ステータスが0のレコード数を取得
            ->select('applications.lesson_id', DB::raw('COUNT(applications.status = 0 OR null) AS applicants_number'))
            // lesson_idごとに、グルーピングする
            ->groupBy('applications.lesson_id');
    }

    /* アクセサ get~~~Attribute
    ------------------------------------------------------------------------------------------------------*/
    /**
     * アクセサ：レッスン番号を漢字に
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
     * アクセサ：日付を西暦ハイフン区切り時刻なしに
     *
     * @return string
     */
    public function getSeparateHyphenDateAttribute()
    {
        return $this->date->format("Y-m-d");
    }

    /**
     * アクセサ：日付を月日
     *
     * @return string
     */
    public function getFormatedMdDateAttribute()
    {
        return $this->date->format("n月j日");
    }

    /**
     * アクセサ：日付に曜日を付加する
     *
     * @return string
     */
    public function getAddWeekDateAttribute()
    {
        $week = ['日', '月', '火', '水', '木', '金', '土'];
        return $this->date->format("n/j") . "({$week[$this->date->format("w")]})";
    }

    /**
     * アクセサ：日付に曜日を付加する
     *
     * @return string
     */
    public function getWeekAttribute()
    {
        $week = ['日', '月', '火', '水', '木', '金', '土'];
        return "{$week[$this->date->format("w")]}";
    }

    /**
     * アクセサ：時刻の開始終了をハイフン区切りに
     *
     * @return string
     */
    public function getSeparateHyphenTimeAttribute()
    {
        return $this->start->format("H:i") . '-' . $this->finish->format("H:i");
    }

    /**
     * アクセサ：金額をカンマ区切り
     *
     * @return string
     */
    public function getSeparateCommaPriceAttribute()
    {
        return '¥' . number_format($this->price);
    }

    /**
     * アクセサ：キャンセル金額をカンマ区切りで算出
     *
     * @return string
     */
    public function getCommaCancelPriceAttribute()
    {
        return number_format(ceil($this->price * $this->cancel_rate / 100));
    }

    /**
     * アクセサ：レッスンの講師プロフィール画像を取得
     *
     * @return string
     */
    public function getPublicPathUsersImgAttribute()
    {
        $user = new User();
        return $user->createProfilePublicPath($this->users_img);
    }

    /**
     * アクセサ：コース画像1の公開パスを取得
     * @return string
     */
    public function getPublicPathCourseImg1Attribute()
    {
        $course = new Course();
        return $course->createCoursePublicPath($this->courses_img1);
    }

    /**
     * アクセサ：講師の評価値を少数第一までにフォーマット
     * @return string
     */
    public function getRoundAvgPointAttribute()
    {
        // return $this->hasMany('App\Models\Evaluation');
        return round($this->evaluations_avg_point, 1);
    }

    /**
     * アクセサ：日付の出力形式を MM/DD に変換
     *
     * @return string
     */
    public function getDateSlashAttribute()
    {
        // レッスン別の申込数を集計
        return date('m/d',  strtotime($this->date));
    }

}
