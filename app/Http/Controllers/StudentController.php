<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\SendRequest as MessageSendRequest;
use App\Http\Requests\User\UpdateRequest as UserUpdateRequest;
use App\Http\Requests\User\PasswordUpdateRequest as UserPasswordUpdateRequest;
use App\Models\Lesson;
use App\Models\Message;
use App\Models\Payment;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;

class StudentController extends Controller
{
    private $lesson;
    private $message;
    private $payment;
    private $user;
    private $withdraw;

    public function __construct(
        Lesson $lesson,
        Message $message,
        Payment $payment,
        User $user,
        Withdraw $withdraw
    )
    {
        $this->lesson = $lesson;
        $this->message = $message;
        $this->payment = $payment;
        $this->user = $user;
        $this->withdraw = $withdraw;
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
        $partner_users = $this->message->getUsersWithLatestMessage();
        if ($request->query('partner_users_id')) {
            $partner_users_id = $request->query('partner_users_id');
        } else {
            $partner_users_id = $partner_users->isEmpty() ? 0 : $partner_users[0]->users_id;
        }
        $message_details = $this->message->getConversation($partner_users_id);
        // 既読に更新(PC)
        $agent = new Agent();
        if(!$agent->isMobile()) {
            DB::transaction(function () use ($message_details) {
                $this->message->saveRead($message_details);
            });
        }

        return view('students.messages', compact('partner_users', 'message_details'));
    }

    /**
     * メッセージ詳細
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function messageDetail(Request $request)
    {
        $partner_users_id = $request->partner_users_id;
        $message_details = $this->message->getConversation($partner_users_id);
        // dd($message_details);
        // 既読に更新(スマホ)
        DB::transaction(function () use ($message_details) {
            $this->message->saveRead($message_details);
        });
        // dd($message_details);

        return view('students.message-detail', compact('message_details', 'partner_users_id'));
    }

    /**
     * メッセージ送信処理
     *
     * @param MessageSendRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function sendMessages(MessageSendRequest $request)
    {
        $message = new Message();
        $message->user_send_id = Auth::user()->id;
        $message->user_receive_id = $request->partner_users_id;
        $message->message_detail = $request->message_detail;
        $message->saveImgs($request);
        $message->save();

        $agent = new Agent();
        if($agent->isMobile()) {
            return redirect(route('mypage.u.messages.detail', ['partner_users_id' => $message->user_receive_id ]));
        } else {
            return redirect(route('mypage.u.messages', ['partner_users_id' => $message->user_receive_id]));
        }
    }

    /**
     * プロフィール編集ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function profile(Request $request)
    {
        $user = $this->user->query()->find(Auth::user()->id);
        $sexes = User::getArraySexes();

        return view('students.profile', compact('user', 'sexes'));
    }

    /**
     * プロフィール更新処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updateProfile(UserUpdateRequest $request)
    {
        $user = $this->user->query()->find(Auth::user()->id);
        $user->name = $request->name;
        $user->profile = $request->profile;
        $user->saveImgs($request);
        $user->save();

        return redirect(route('mypage.u.profile'));
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePassword(UserPasswordUpdateRequest $request)
    {
        // パスワードを変更
        $user = $this->user->query()->find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

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
        DB::transaction(function () {
            $this->withdraw->executeWithdraw();
        });

        // ログアウト
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('mypage.u.withdrawal.complete'));
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
        $holding_amount = $this->payment->getHoldingAmount();
        $trade_months = $this->payment->getMonths();
        $trade_details = $this->payment->getDetail();

        return view('students.trade', compact('holding_amount', 'trade_months', 'trade_details'));
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
