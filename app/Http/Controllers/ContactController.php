<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;


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

        // 画像をstorageに保存する
        if($request['img']) {
            $file = $request->file('img');
            $path = $file->store('contact',"public");
            $path_image = str_replace('contact/', '', $path);
        }
        // $image = basename(Storage::putFile(Config::get('const.image_path.course'), $validated['img']));

        // 相手への送信メール
        Mail::send(new \App\Mail\ContactMail([
            'to' => $validated['email'],
            'to_name' => $validated['name'],
            'from' => 'info@okeicom.com',
            'from_name' => '【自動返信】お問い合わせ完了 おけいcom',
            'subject' => 'お問い合わせありがとうございました。',
            'body' => $validated,
            'image' => $path_image,
        ]));

        // 自社への受信メール
        Mail::send(new \App\Mail\ContactMail([
            'to' => 'info@okeicom.com',
            'to_name' => 'おけいcom',
            'from' => $validated['email'],
            'from_name' => $validated['name'],
            'subject' => 'おけいcom お問い合わせフォームよりお問い合わせがきました。',
            'body' => $validated,
            'image' => $path_image,
        ], 'from'));

        // DBに登録
        $contact = new Contact;
        // パラーメーターに値を入れてDBに保存
        $params['email']    = $request['email'];
        $params['name']     = $request['name'];
        $params['class']    = $request['class'];
        $params['subject']  = $request['subject'];
        if($path) {
            // $params['img']  = $image;
            $params['img']  = $path_image;
        }
        $params['detail']   = $request['detail'];
        $contact->create($params);

        // 二重送信予防
        $request->session()->regenerateToken();

        return redirect(route('contact.complete'));
    }

    /**
     * 問い合わせ完了ページ
     *
     * @param Request $request
     * @return Factory|View
     */
    public function complete(Request $request)
    {
        return view('contacts.complete');
    }
}
