<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Mail\WithdrawalRequest;
use App\Http\Requests\Message\SendRequest as MessageSendRequest;
use App\Http\Requests\User\UpdateRequest as UserUpdateRequest;
use App\Http\Requests\User\PasswordUpdateRequest as UserPasswordUpdateRequest;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Message;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Withdraw;
use App\Models\Prefecture;
use App\Models\OthersBank;
use App\Models\JapansBank;
use App\Models\Withdrawal;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;

class StudentController extends Controller
{
    private $user;
    private $lesson;
    private $message;
    private $payment;
    private $withdraw;
    private $category;
    private $prefecture;
    private $others_bank;
    private $japans_bank;
    private $withdrawal;

    public function __construct(
        User $user,
        Lesson $lesson,
        Message $message,
        Payment $payment,
        Withdraw $withdraw,
        Category $category,
        Prefecture $prefecture,
        OthersBank $others_bank,
        JapansBank $japans_bank,
        withdrawal $withdrawal
    )
    {
        $this->user = $user;
        $this->lesson = $lesson;
        $this->message = $message;
        $this->payment = $payment;
        $this->withdraw = $withdraw;
        $this->category = $category;
        $this->prefecture = $prefecture;
        $this->others_bank = $others_bank;
        $this->japans_bank = $japans_bank;
        $this->withdrawal = $withdrawal;
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
     * 受講予定レッスン一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function attendanceLessons(Request $request)
    {
        $status = 0;
        $lessons = $this->lesson->findByAuthUsersId($status);

        // $user_id = Auth::user()->id;
        // $date = Carbon::now()->format('Y-m-d');
        // $time = Carbon::now()->format('H:m:s');

        // 予約済み一覧を取得
        // $lessons = Application::where('user_id', $user_id)->where('status', 0)->get();
        // 受講予定のレッスン一覧
        // $lessons = [];
        // 対象のレッスン
        // $number = count($applications);
        // for($i = 0; $i < $number; $i++) {
        //     $target = $this->lesson
        //         ->getShowLesson($applications[$i]->lesson_id)
        //         ->where('date', '>', $date)
        //         ->where('finish', '>', $time)
        //         ->where('status', 0)
        //         ->first();
        //     if($target) {
        //         $lessons[] = $target;
        //     }
        // }

        // where('date', '>', $date)->where('finish', '>', $time)->
        return view('students.attendance-lessons', compact('lessons'));
    }

    /**
     * 受講済みレッスン一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function takenLessons(Request $request)
    {
        $lessons = $this->lesson->findByTakenLessonOfUsersId();

        // // 予約済み一覧を取得
        // $applications = Application::where('user_id', $user_id)->where('status', 0)->get();

        // // 受講予定のレッスン一覧
        // $lessons = [];
        // // 対象のレッスン
        // $number = count($applications);
        // for($i = 0; $i < $number; $i++) {
        //     // ステータスとデータが紐づくレッスン一覧を取得
        //     $target = $this
        //         ->lesson
        //         ->getShowLesson($applications[$i]->lesson_id)
        //         ->where('date', '<', $date)
        //         // ->where('finish', '<', $time)
        //         ->where('status', 0)
        //         ->first();
        //     $course_id = $target->course_id;
        //     if($target) {
        //         // コースIDの中での番号を取得し、連想配列に入れる
        //         $keyIndex = $this->lesson->getLessonNumberOfCourse($course_id, $target->id);

        //         // レッスン情報に数字を入れる
        //         $target['number'] = $keyIndex;

        //         // レッスン配列にレッスンを入れる
        //         $lessons[] = $target;
        //     }
        // }


        // array_search(3, array_column($lessons, 'id')) + 1

        return view('students.taken-lessons', compact('lessons'));
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
        // dd($partner_users);
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
        $user_status = Auth::user()->status;
        return view('students.messages', compact('partner_users', 'message_details', 'user_status'));
    }

    /**
     * メッセージ詳細
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function messageDetail(Request $request)
    {
        // ユーザー情報
        $partner_users_id = $request->partner_users_id;
        $user_name = User::find($partner_users_id)->name;
        $user_img = User::find($partner_users_id)->img;
        $user_status = Auth::user()->status;
        $message_details = $this->message->getConversation($partner_users_id);
        $message_received = $request->messages_detail;
        // 既読に更新(スマホ)
        DB::transaction(function () use ($message_details) {
            $this->message->saveRead($message_details);
        });
        return view('students.message-detail', compact('message_details', 'partner_users_id', 'user_name', 'user_img', 'user_status','message_received'));
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
        // if($agent->isMobile()) {
        //     return redirect(route('mypage.u.messages.detail', ['partner_users_id' => $message->user_receive_id ]));
        // } else {
        //     return redirect(route('mypage.u.messages', ['partner_users_id' => $message->user_receive_id]));
        // }
        return redirect(route('mypage.u.messages.detail', ['partner_users_id' => $message->user_receive_id, 'messages_detail'=>$message->message_detail]));
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
        $categories = $this->category->getAll();
        $prefecturies = $this->prefecture->getAll();
        $user_status = Auth::user()->status;
        return view('students.profile', compact('user', 'sexes', 'categories', 'prefecturies', 'user_status'));
    }

    /**
     * プロフィール更新処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updateProfile(UserUpdateRequest $request)
    {

        DB::transaction(function () use($request) {
            $user                   = $this->user->query()->find(Auth::user()->id);
            $user->name             = $request->name;
            $user->email            = $request->email;
            $user->profile          = $request->profile;
            $user->country_id       = $request->country_id;
            $user->language_id      = $request->language_id;
            $user->prefecture_id    = $request->prefecture_id;
            $user->saveCategories($request);
            $user->saveImgs($request);
            $user->save();
        });

        // リダイレクト先を、現在のユーザー状態に合わせて変更
        $url = '';
        if(Auth::user()->status == 0) {
            $url = 'mypage.u.profile';
        } else {
            $url = 'mypage.t.profile';
        };
        return redirect(route($url));
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
        $user_status = Auth::user()->status;
        // return view('students.withdrawal-create');
        return view('students.withdrawal-create', compact('user_status'));
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
        $trade_months   = $this->payment->getMonths();
        $trade_details  = $this->payment->getDetail();
        $user_status    = Auth::user()->status;
        return view('students.trade', compact('holding_amount', 'trade_months', 'trade_details', 'user_status'));
    }

    /**
     * 出金リクエストページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createPayment(Request $request)
    {
        // 出金情報
        $user_status = Auth::user()->status;
        $holding_amount = $this->payment->getHoldingAmount();

        // DBから銀行情報を取得する
        $bankDate = '';
        $target = '';
        if(JapansBank::where('user_id', Auth::id())->first()) {
            $bankDate = JapansBank::where('user_id', Auth::id())->first();
            $bankDate['japan_name'] = $bankDate['name'];
            $bankDate['japan_number'] = $bankDate['number'];
            $target = 0;
        } elseif(OthersBank::where('user_id', Auth::id())->first()) {
            $bankDate = OthersBank::where('user_id', Auth::id())->first();
            $bankDate['other_name'] = $bankDate['name'];
            $bankDate['other_number'] = $bankDate['number'];
            $target = 1;
        }

        // IDをセッションに保存（出金履歴の登録時に必要）
        if($bankDate['id']) {
            session(['id' => $bankDate['id']]);
        }
        return view('students.payment-create', compact('holding_amount', 'user_status', 'bankDate', 'target'));
    }

    /**
     * 出金リクエスト処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storePayment(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_status = Auth::user()->status;
        $bank_type = $request->bank_type;

        // 銀行情報と出金リクエスト登録
        DB::transaction(function () use($request, $user_id, $bank_type) {
            // １．銀行タイプから、条件分岐でゆうちょかそれ以外かに登録
            // ２．情報を全て登録
            $id = '';
            if(session()->has('id')) {
                $id = session('id');
            } else {
                if($bank_type == 0) {
                    // ゆうちょ銀行
                    $this->japans_bank->registerJapanBank($request, $user_id);
                } elseif($bank_type == 1) {
                    // その他銀行
                    $this->others_bank->registerOtherBank($request, $user_id);
                }
                // ３．登録した銀行IDを取得
                $id = DB::getPdo()->lastInsertId();
            }

            // ４．全てをwithdrawals tableに登録
            $this->withdrawal->store($request, $user_id, $id);

            // ５．出金完了メール送信
            $user = Auth::user();
            $email = new WithdrawalRequest($user, $request);
            Mail::to(Auth::user()->email)->send($email);
        });

        // ５．取引履歴
        return view('students.payment-complete', compact('user_status'));
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

    /**
     * ステータス変更
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function change(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->status = 1;
        $user->save();
        // $this->user->changeStatus($user_id);
        return redirect(route('mypage.t.courses'));
    }
}
