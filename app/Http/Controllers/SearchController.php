<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // レッスン
        // キーワード受け取り
        $keyword = $request->input('keyword');
        // クエリ生成
        $query   = Lesson::query();
        // キーワードがあったら
        if($keyword) {
            // 検索キーワードを含む（部分一致）レッスンを一覧を取得
            // タイトル及び説明から情報を取得
            $query->where('title', 'like', '%'.$keyword.'%')->orWhere('detail','like','%'.$keyword.'%');
        };
        // エンコード処理
        $lessons = json_encode($query->get());
        // 検索画面に、「レッスン一覧」と「キーワード」情報を送る
        return view('searches.index', compact('lessons', 'keyword'));
    }
}
