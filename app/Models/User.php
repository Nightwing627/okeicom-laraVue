<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
     * 性別の名称を取得
     *
     * @param $value
     * @return array
     */
    public function getSexNameAttribute()
    {
        $sex_name = '';
        switch ($this['sex']) {
            case self::SEX_UNKNOWN:
                $sex_name = __('UserSexUnknown');
                break;
            case self::SEX_MALE:
                $sex_name =  __('UserSexMale');
                break;
            case self::SEX_FEMALE:
                $sex_name =  __('UserSexFemale');
                break;
        }
        return $sex_name;
    }

    /**
     * 講師の評価値を少数第一までにフォーマット
     * @return string
     */
    public function getRoundAvgPointAttribute()
    {
        return round($this->evaluations_avg_point, 1);
    }

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

    /**
     * プロフィール画像保存処理
     */
    public function saveImgs($request)
    {
        if ($request->hasFile('img')) {
            if ($request->file('img')->isValid()) {
                $this->img = basename(Storage::putFile(Config::get('const.image_path.profile'), $request->file('img')));
            }
        }
    }

    /**
     * プロフィール画像の公開パスを取得
     * @return string
     */
    public function getPublicPathImgAttribute()
    {
        return $this->createProfilePublicPath($this->img);
    }

    /**
     * プロフィール画像の公開パスを生成
     *
     * @param string $img
     * @return string
     */
    public function createProfilePublicPath($img)
    {
        if ($img) {
            return '/storage/profile/' . $img;
        } else {
            return '';
        }
    }

    /**
     * 講師の評価値を取得するクエリを取得
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTeachersPointQuery()
    {
        // 講師別の評価値を集計
        return Evaluation::query()
             ->select(
                 'evaluations.user_teacher_id',
                 DB::raw('avg(evaluations.point) as avg_point')
             )
             ->groupBy('evaluations.user_teacher_id');
    }

    /**
     * 指定レッスンの参加者一覧取得
     *
     * @param int $users_id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findByLessonsId(int $lessons_id, int $users_id)
    {
        return self::query()
            ->select([
                'users.*',
                'prefectures.name as prefectures_name',
            ])
            ->join('applications', 'users.id', '=', 'applications.user_id')
            ->join('lessons', 'applications.lesson_id', '=', 'lessons.id')
            ->leftJoin('prefectures', 'users.prefecture_id', '=', 'prefectures.id')
            ->where('lessons.user_id', $users_id)
            ->where('applications.lesson_id', $lessons_id)
            ->orderBy('applications.created_at', 'desc')
            ->get();
    }

    /**
     * ログイン中のユーザ削除
     *
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function deleteLoggedUser() {
        return self::query()->find(Auth::user()->id)->delete();
    }

    /**
     * 高評価の講師を取得
     *
     * @param int $users_id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPopularTeachers()
    {
        // 講師別の評価値を集計
        $evaluations = $this->getTeachersPointQuery();

        return self::query()
            ->select([
                'users.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            ->leftJoin('categories as categories1', 'users.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'users.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'users.category3_id', '=', 'categories3.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
                $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                      ->from('lessons')
                      ->whereRaw('lessons.user_id = users.id');
            })
            ->orderByDesc('evaluations.avg_point')
            ->orderBy('users.created_at')
            ->limit(Config::get('const.top_thumbnail_count'))
            ->get();
    }

    /**
     * 新着講師を取得
     *
     * @param int $users_id
     * @return array|\Illuminate\Database\Concerns\BuildsQueries[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getNewArrivalTeachers()
    {
        // 講師別の評価値を集計
        $evaluations = $this->getTeachersPointQuery();

        return self::query()
            ->select([
                'users.*',
                'categories1.name as category1_name',
                'categories2.name as category2_name',
                'categories3.name as category3_name',
                'evaluations.avg_point as evaluations_avg_point',
            ])
            ->leftJoin('categories as categories1', 'users.category1_id', '=', 'categories1.id')
            ->leftJoin('categories as categories2', 'users.category2_id', '=', 'categories2.id')
            ->leftJoin('categories as categories3', 'users.category3_id', '=', 'categories3.id')
            ->leftJoinSub($evaluations, 'evaluations', function ($join) {
               $join->on('users.id', '=', 'evaluations.user_teacher_id');
            })
            ->whereExists(function ($query) {
               $query->select(DB::raw(1))
                     ->from('lessons')
                     ->whereRaw('lessons.user_id = users.id');
            })
            ->orderByDesc('users.created_at')
            ->limit(Config::get('const.top_thumbnail_count'))
            ->get();
    }
}
