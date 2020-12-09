<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * 問い合わせページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function contact(Request $request)
    {
        return view('contacts.index');
    }

    /**
     * 問い合わせ実行
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function doContact(Request $request)
    {
        return redirect(route('faq'));
    }
}
