<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $lesson;

    public function __construct(
        Lesson $lesson
    )
    {
        $this->lesson = $lesson;
    }

    /**
     * 受講者ダッシュボード
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('students.index');
    }

    /**
     * 受講予定・受講済みレッスン一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function attendanceLessons(Request $request)
    {
        $applications_status = $request->query('applications_status') == 1 ? 1 : 0;
        $lessons = $this->lesson->findByAuthUsersId($applications_status);

        return view('students.attendance-lessons', compact('lessons', 'applications_status'));
    }

    /**
     * メッセージ一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function messages(Request $request)
    {
        return view('students.messages');
    }

    /**
     * メッセージ詳細
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function messageDetail(Request $request)
    {
        return view('students.message-detail');
    }

    /**
     * プロフィール
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profile(Request $request)
    {
        return view('students.profile');
    }

    /**
     * パスワード更新ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editPassword(Request $request)
    {
        return view('students.password-edit');
    }

    /**
     * パスワード更新処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updatePassword(Request $request)
    {
        return redirect(route('mypage.u.profile'));
    }

    /**
     * 退会ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createWithdrawal(Request $request)
    {
        return view('students.withdrawal-create');
    }

    /**
     * 退会処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeWithdrawal(Request $request)
    {
        return redirect(route('withdrawal.complete'));
    }

    /**
     * 退会完了ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function completeWithdrawal(Request $request)
    {
        return view('students.withdrawal-complete');
    }

    /**
     * クレジット一覧ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function creditcards(Request $request)
    {
        return view('students.creditcards');
    }

    /**
     * クレジット追加ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createCreditcards(Request $request)
    {
        return view('students.creditcards-create');
    }

    /**
     * クレジット登録処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeCreditcards(Request $request)
    {
        return redirect(route('mypage.u.creditcards'));
    }

    /**
     * クレジット編集ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function editCreditcards(Request $request)
    {
        return view('students.creditcards-edit');
    }

    /**
     * クレジット更新処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updateCreditcards(Request $request)
    {
        return redirect(route('mypage.u.creditcards'));
    }

    /**
     * 入出金履歴ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function trade(Request $request)
    {
        return view('students.trade');
    }

    /**
     * 出金リクエストページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createPayment(Request $request)
    {
        return view('students.payment-create');
    }

    /**
     * 出金リクエスト処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storePayment(Request $request)
    {
        return redirect(route('payment.complete'));
    }

    /**
     * 出金リクエスト完了ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function completePayment(Request $request)
    {
        return view('students.payment-complete');
    }
}
