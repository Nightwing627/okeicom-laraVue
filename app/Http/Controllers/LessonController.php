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
}
