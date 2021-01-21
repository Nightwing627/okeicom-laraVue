<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Category;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;

class SearchController extends Controller
{
    private $lesson;
    private $category;
    private $Evaluation;
    private $user;

    public function __construct(
        Lesson $lesson,
        Category $category,
        User $user
    )
    {
        $this->lesson = $lesson;
        $this->category = $category;
        $this->user = $user;
    }
    public function index(Request $request)
    {
        // キーワードがある場合、パラーメーターに保存
        if(isset($request->keyword)) { $params['keyword'] = $request->keyword; }
        // カテゴリーがある場合、パラーメーターにカテゴリーを保存
        if(isset($request->categories_id)) { $params['categories_id'] = $request->categories_id; }
        // 日付がある場合、パラーメーターに日付を保存
        if(isset($request->select_date)) { $params['select_date'] = $request->select_date; }
        // ターゲットに値がある場合、パラーメーターにターゲットを保存
        if(isset($request->is_target)) { $params['is_target'] = $request->is_target; }
        // ソートに値がある場合、パラーメーターにソートを保存
        if(isset($request->sort_param)) { $params['sort_param'] = $request->sort_param; }

        // dd($params);
        $sort_param    = $request->sort_data;
        $categories_id = $request->categories_id;

        $lessons       = $this->lesson->findBySearchKeyword($params, $categories_id)->DynamicOrderBy($sort_param)->paginate(20);
        $categories    = $this->category->getAll(true);

        // クエリ生成
        // $query   = Lesson::query();
        // // キーワードがあったら
        // if($keyword) {
        //     // 検索キーワードを含む（部分一致）レッスンを一覧を取得
        //     // タイトル及び説明から情報を取得
        //     $query->where('title', 'like', '%'.$keyword.'%')->orWhere('detail','like','%'.$keyword.'%');
        // };
        // // エンコード処理
        // $lessons = json_encode($query->get());
        // 検索画面に、「レッスン一覧」と「キーワード」情報を送る
        return view('searches.index', compact('sort_param', 'params', 'lessons', 'categories'));
    }
}
