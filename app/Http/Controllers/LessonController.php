<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Category;
use App\Models\Evaluation;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;

class LessonController extends Controller
{
    private $lesson;
    private $category;
    private $evaluation;

    public function __construct(
        Lesson $lesson,
        Category $category,
        Evaluation $evaluation
    )
    {
        $this->lesson = $lesson;
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
        // [未実装]どの情報を受け取るかをバリデーションの設定を行う（想定外を書き出す → 404ページを返す：アボートメソッド）
        // リクエストからsortChangeの値をparamsに入れる
        $params     = $request->sortChange;
        // 全件検索 / 並び替え機能 / ページネーション機能
        $lessons    = $this->lesson->search()->DynamicOrderBy($params)->paginate(20);
        $categories = $this->category->getAll(true);
        $evaluation = $this->evaluation->getAll(true);
        dd($evaluation);
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
        $categories_id = $request->query('categories_id');
        $lessons       = $this->lesson->findByCategoriesId($categories_id);
        $categories    = $this->category->getAll(true);
        return view('lessons.index', compact('lessons', 'categories'));
    }

    /**
     * レッスン詳細
     *
     * @param Request $request
     * @return Factory|View
     */
    public function detail(Request $request)
    {
        return view('lessons.detail');
    }

    /**
     * レッスン予約ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function application(Request $request)
    {
        return view('lessons.application');
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
