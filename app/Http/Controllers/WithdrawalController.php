<?php

namespace App\Http\Controllers;

use App\Mail\WithdrawalRequest;
use App\Models\Withdrawal;
use App\Models\Bank;
use App\Models\BankOther;
use App\Models\BankJapan;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Http\Controllers\Controller,
    Session;

class WithdrawalController extends Controller
{
    /**
     * CSVエクスポート処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function csvExport(Request $request)
    {
        $post = $request->all();
        $response = new StreamedResponse(function () use ($request, $post) {
            // fopen関数でブラウザを開く
            $stream = fopen('php://output','w');
            $withdrawal = new Withdrawal();

            // 文字化け回避
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
            // ヘッダー行追加
            fputcsv($stream, $withdrawal->csvHeader());

            $results = $withdrawal->getCsvData($post['start_date'], $post['end_date']);

            if (empty($results[0])) {
                fputcsv($stream, [
                    'データが存在しませんでした。',
                ]);
            } else {
                foreach ($results as $row) {
                    fputcsv($stream, $withdrawal->csvRow($row));
                }
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('content-disposition', 'attachment; filename='. $post['start_date'] . '〜' . $post['end_date'] . 'お問い合わせ一覧.csv');
        return $response;
    }

    /**
     * 出金リクエストページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function withdrawalRequest(Request $request)
    {
        $user_status = Auth::user()->status;
        $userId = Auth::id();
        $commitionRate = Auth::user()->commition_rate;
        // 出金合計金額
        $paymentNew = new Payment();
        $holding_amount = $paymentNew->getHoldingAmount();

        // 出金金額によって手数料率を算出する
        $fee = '';
        if(is_null($commitionRate)) {
          switch(true) {
            case $holding_amount > 300001:
                $fee = 25;
                break;
            case $holding_amount > 250001:
                $fee = 23;
                break;
            case $holding_amount > 200001:
                $fee = 20;
                break;
            case $holding_amount > 150001:
                $fee = 18;
                break;
            case $holding_amount > 100001:
                $fee = 15;
                break;
            default:
                $fee = 13;
                break;
          }
        } else {
          $fee = $commitionRate;
        }

        // 出金額と手数料を表示
        $commission = $holding_amount * $fee / 100;
        session()->put([
            'holding_amount'    => $holding_amount,
            'commission'        => $commission,
            'withdrawal_amount' => $holding_amount - $commission,
            'fee'               => $fee,
        ]);


        // DBから銀行情報を取得する
        // $bankDate = '';
        // $target = '';
        // if(JapansBank::where('user_id', Auth::id())->first()) {
        //     $bankDate = JapansBank::where('user_id', Auth::id())->first();
        //     $bankDate['japan_name'] = $bankDate['name'];
        //     $bankDate['japan_number'] = $bankDate['number'];
        //     $target = 0;
        // } elseif(OthersBank::where('user_id', Auth::id())->first()) {
        //     $bankDate = OthersBank::where('user_id', Auth::id())->first();
        //     $bankDate['other_name'] = $bankDate['name'];
        //     $bankDate['other_number'] = $bankDate['number'];
        //     $target = 1;
        // }

        // 銀行情報を取得する
        $bankNew = new Bank();
        $bankDate = $bankNew->showBank($userId);

        // IDをセッションに保存（出金履歴の登録時に必要）
        if(isset($bankDate['id'])) {
            session(['id' => $bankDate['id']]);
        }
        return view('students.payment-create', compact('bankDate'));
    }


    /**
     * 出金リクエスト処理
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function withdrawalRequestConfirmed(Request $request)
    {
        $userId = Auth::user()->id;
        $banks = $request->all();

        // 銀行情報と出金リクエスト登録
        DB::beginTransaction();
        try {
          // １．銀行情報の登録
          $bankNew = new Bank();
          $res = $bankNew->storeBank($banks, $userId);
          if(!is_numeric($res)) {
              return back()->withInput()->withErrors($res);
          }

          // ２．出金リクエストの登録
          $withdrawalNew = new Withdrawal();
          $withdrawalNew->store($res, $userId);

          // ３．出金完了メール送信
          $user = Auth::user();
          $email = new WithdrawalRequest($user, $request);
          Mail::to(Auth::user()->email)->send($email);

          // ４．トランザクションを通過してDBにcommit
          DB::commit();

          // ５．セッション削除
          $request->session()->forget(['holding_amount', 'commission', 'withdrawal_amount', 'fee']);

          // ６．出金リクエスト完了ページへリダイレクト
          return redirect(route('mypage.t.payment.complete'));
        } catch (\Exception $e) {
          DB::rollback();
          $error = '出金リクエストに失敗しました。再度登録を行ってください。';
          return back()->withErrors($error);
        }
        $error = '不明なエラーが発生しました。管理者へお問い合わせください。';
        return back()->withErrors($error);

        // DB::transaction(function () use($request, $userId, $bank_type) {
        //     // １．銀行タイプから、条件分岐でゆうちょかそれ以外かに登録
        //     // ２．情報を全て登録
        //     $id = '';
        //     if(session()->has('id')) {
        //         $id = session('id');
        //     } else {
        //         if($bank_type == 0) {
        //             // ゆうちょ銀行
        //             $this->japans_bank->registerJapanBank($request, $userId);
        //         } elseif($bank_type == 1) {
        //             // その他銀行
        //             $this->others_bank->registerOtherBank($request, $userId);
        //         }
        //         // ３．登録した銀行IDを取得
        //         $id = DB::getPdo()->lastInsertId();
        //     }

        //     // ４．全てをwithdrawals tableに登録
        //     $this->withdrawal->store($request, $userId, $id);

        //     // ５．出金完了メール送信
        //     $user = Auth::user();
        //     $email = new WithdrawalRequest($user, $request);
        //     Mail::to(Auth::user()->email)->send($email);
        // });

    }

    /**
     * 出金リクエスト完了ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function withdrawalRequestCompleted(Request $request)
    {
        return view('students.payment-complete');
    }

}
