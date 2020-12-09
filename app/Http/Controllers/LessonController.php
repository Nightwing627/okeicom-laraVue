<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lesson;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LessonController extends Controller
{
    private $lesson;
    private $category;

    public function __construct(
        Lesson $lesson,
        Category $category
    )
    {
        $this->lesson = $lesson;
        $this->category = $category;
    }

    /**
     * レッスン一覧
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $lessons = $this->lesson->search($params);
        $categories = $this->category->getAll(true);

        return view('lessons.index', compact('lessons', 'categories'));
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
        $lessons = $this->lesson->findByCategoriesId($categories_id);
        $categories = $this->category->getAll(true);

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
