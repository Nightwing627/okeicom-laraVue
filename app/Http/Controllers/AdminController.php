<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * ユーザ一覧
     *
     * @param Request $request
     * @return Factory|View
     */
    public function indexUsers(Request $request)
    {
        return view('admins.users-index');
    }

    /**
     * ユーザ一追加ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function createUsers(Request $request)
    {
        return view('admins.users-create');
    }

    /**
     * ユーザ一登録処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function storeUsers(Request $request)
    {
        return redirect(route('admins.users.index'));
    }

    /**
     * ユーザ一編集ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function editUsers(Request $request)
    {
        return view('admins.users-edit');
    }

    /**
     * ユーザ一更新処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function updateUsers(Request $request)
    {
        return redirect(route('admins.users.index'));
    }

    /**
     * 出金リクエスト
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function requestWithdraws(Request $request)
    {
        return view('admins.withdraws-request');
    }
}


