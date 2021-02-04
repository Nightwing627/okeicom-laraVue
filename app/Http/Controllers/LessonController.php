<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Category;
use App\Models\Evaluation;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use App\Http\Resources\LessonDetailResource;
use Illuminate\Support\Facades\Auth;
class LessonController extends Controller
{
    private $user;
    private $lesson;
    private $category;
    private $evaluation;

    public function __construct(
        User $user,
        Lesson $lesson,
        Course $course,
        Category $category,
        Evaluation $evaluation
    )
    {
        $this->user = $user;
        $this->lesson = $lesson;
        $this->course = $course;
        $this->category = $category;
        $this->evaluation = $evaluation;
    }

    /**
     * レッスン一覧
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $params = [];
        // カテゴリーがある場合、パラーメーターにカテゴリーを保存
        if(isset($request->categories_id)) { $params['categories_id'] = $request->categories_id; }
        // ソートに値がある場合、パラーメーターにソートを保存
        if(isset($request->sort_param)) { $params['sort_param'] = $request->sort_param; }
        // 全件検索 / 並び替え機能 / ページネーション機能
        $lessons    = $this->lesson->search()->DynamicOrderBy($params)->paginate(20);
        $categories = $this->category->getAll(true);
        return view('lessons.index', compact('params', 'lessons', 'categories'));
    }

    /**
     * カテゴリ別レッスン一覧
     *
     * @param Request $request
     * @return Factory|View
     */
    public function category(Request $request)
    {
        // dd($request);
        // $sort_param    = $request->query('sort_param');
        // $categories_id = $request->query('categories_id');
        if(isset($request->categories_id)) { $params['categories_id'] = $request->categories_id; }
        // ソートに値がある場合、パラーメーターにソートを保存
        if(isset($request->sort_param)) { $params['sort_param'] = $request->sort_param; }
        $lessons    = $this->lesson->findByCategoriesId($params)->DynamicOrderBy($params)->paginate(20);
        $categories = $this->category->getAll(true);
        return view('lessons.index', compact('params', 'lessons', 'categories'));
    }

    /**
     * レッスン詳細
     *
     * @param Request $request
     * @return Factory|View
     */
    public function detail($id)
    {
        // レッスン情報
        $lesson         = $this->lesson->getShowLesson($id)->first();
        // レッスンの講師情報
        $user           = User::find($lesson->user_id);
        // レッスンの講師の評価情報
        $evaluations    = $this->evaluation->index($lesson->user_id)->get();
        // 関連レッスン一覧
        $relatedLessons = $this->lesson->findByCoursesId($lesson->course_id, $lesson->user_id);
        // コース画像一覧を配列で取得
        $courseImgLists = $this->course->courseImgLists($lesson->course_id);
        return view('lessons.detail', compact('id', 'lesson', 'user', 'evaluations', 'relatedLessons', 'courseImgLists'));
    }

    /**
     * レッスン予約ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function application(Request $request)
    {
        $id     = $request->id;
        $lesson = $this->lesson->getShowLesson($id)->first();
        $courseImg = $this->course->courseImgLists($lesson->course_id)['img1'];
        $user_status = Auth::user()->status;
        return view('lessons.application', compact('lesson', 'courseImg', 'user_status'));
    }

    /**
     * クレジットカード決済ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function paymentCredit(Request $request)
    {
        return view('lessons.credit-payment');
    }

    /**
     * クレジットカード決済失敗ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function errorApplication(Request $request)
    {
        return view('lessons.application-error');
    }

    /**
     * クレジットカード決済完了ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function completeApplication(Request $request)
    {
        return view('lessons.application-complete');
    }

    /**
     * レッスンキャンセルページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function cancel(Request $request)
    {
        return view('lessons.cancel');
    }

    /**
     * レッスンキャンセル実行処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function doCancel(Request $request)
    {
        return redirect(route('lessons.cancel.complete'));
    }

    /**
     * レッスンキャンセル完了ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function completeCancel(Request $request)
    {
        return view('lessons.cancel-complete');
    }

    /**
     * 講師評価ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function createEvaluation(Request $request)
    {
        return view('lessons.evaluation-create');
    }

    /**
     * 講師評価実行処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeEvaluation(Request $request)
    {
        return redirect(route('lessons.evaluation.complete'));
    }

    /**
     * 講師評価完了ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function completeEvaluation(Request $request)
    {
        return view('lessons.evaluation-complete');
    }

}
