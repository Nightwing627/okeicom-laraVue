<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;

use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    /**
     * 問い合わせページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('contacts.index');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    /**
     * 問い合わせ実行
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    // public function send(ContactRequest $request)
    public function send(ContactRequest $request)
    {
        // バリデーション情報取得
        $validated = $request->validated();

        $contact = new Contact;
        $params['title']    = $validated['email'];
        $params['email']    = $validated['name'];
        $params['class']    = $validated['class'];
        $params['subject']  = $validated['subject'];
        if($request['img']) {
            $params['img']      = $validated['img'];
        }
        $params['detail']   = $validated['detail'];
        $contact->create($params);

        return view('contacts.complete');
    }
}
