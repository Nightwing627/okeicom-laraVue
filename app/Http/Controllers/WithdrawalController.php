<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\Bank;
use App\Models\BankOther;
use App\Models\BankJapan;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        // 出金合計金額
        $paymentNew = new Payment();
        $holding_amount = $paymentNew->getHoldingAmount();

        // 出金金額によって手数料率を算出する
        $fee = '';
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
        // 出金額と手数料を表示
        $commission = $holding_amount * $fee / 100;
        session()->put([
            'holding_amount'    => $holding_amount,
            'commission'         => $commission,
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
}
