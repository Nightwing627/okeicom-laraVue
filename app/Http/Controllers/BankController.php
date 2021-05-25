<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
// use App\Models\OthersBank;
// use App\Models\JapansBank;
use App\Models\Bank;
use App\Models\BankJapan;
use App\Models\BankOther;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BankController extends Controller
{
    // private $others_bank;
    // private $japans_bank;
    private $bank_japan;
    private $bank_other;

    public function __construct(
        // OthersBank $others_bank,
        // JapansBank $japans_bank,
        BankJapan $bank_japan,
        BankOther $bank_other
    )
    {
        $this->others_bank = $bank_other;
        $this->japans_bank = $bank_japan;
    }

    /**
     *
     * 銀行口座情報 表示
     *
     */
    public function show()
    {
        // DBから銀行情報を取得する
        $userId = Auth::id();
        $bankNew = new Bank();
        $bank = $bankNew->showBank($userId);
        return view('users.banks_show', compact('bank'));
        // 銀行情報を取得する

        // $bankDate = '';
        // $target = '';
        // if(JapansBank::where('user_id', $userId)->first()) {
        //     $bankDate = JapansBank::where('user_id', $userId)->first();
        //     $target = 0;
        // } elseif(OthersBank::where('user_id', $userId)->first()) {
        //     $bankDate = OthersBank::where('user_id', $userId)->first();
        //     $target = 1;
        // }
        // return view('users.banks_show', compact('bankDate', 'target'));
    }

    /**
     *
     * 銀行口座情報 編集
     *
     */
    public function edit()
    {
        // DBから銀行情報を取得する
        $userId = Auth::id();
        $bankNew = new Bank();
        $bank = $bankNew->showBank($userId);

        return view('users.banks_edit', compact('bank'));

        // 銀行情報を取得する
        // $bankDate = '';
        // $target = '';
        // if(JapansBank::where('user_id', $userId)->first()) {
        //     // ゆうちょ銀行
        //     $bankDate = JapansBank::where('user_id', $userId)->first();
        //     $bankDate['japan_name'] = $bankDate['name'];
        //     $bankDate['japan_number'] = $bankDate['number'];
        //     $target = 0;
        // } elseif(OthersBank::where('user_id', $userId)->first()) {
        //     // その他銀行
        //     $bankDate = OthersBank::where('user_id', $userId)->first();
        //     $bankDate['other_name'] = $bankDate['name'];
        //     $bankDate['other_number'] = $bankDate['number'];
        //     $target = 1;
        // }

        // if($bankDate) {
        //     session([
        //         'bank_type' => $target,
        //         'bank_id'   => $bankDate->id,
        //     ]);
        // }

        // return view('users.banks_edit', compact('bankDate', 'target'));
    }

    /**
     *
     * 銀行口座情報 更新
     *
     */
    public function update(UpdateBank $request)
    // public function update(request $request)
    {
        $banks = $request->validated();
        $userId = Auth::id();

        DB::beginTransaction();
        try {
            // 前の銀行情報を物理削除
            $oldBank = Bank::where('user_id' ,$userId)->first();
            if($oldBank) {
                $oldBankId = $oldBank->id;
                // ゆうちょの銀行情報
                if($oldBank->type === 'japan') {
                    BankJapan::where('bank_id', $oldBankId)->delete();
                // その他の銀行情報
                } else if($oldBank->type === 'other') {
                    BankOther::where('bank_id', $oldBankId)->delete();
                }
                $oldBank->delete();
            }
            // 新しく銀行情報を登録する
            $bankNew = new Bank();
            if($banks['yucho_mark']) {
                // 銀行テーブル登録
								$bankLast = $bankNew::create([
										'user_id' => $userId,
										'type' 		=> 'japan',
										'number'  => $banks['yucho_number'],
										'name'    => $banks['yucho_name'],
                ]);
                $lastId = $bankLast->id;

                // ゆうちょテーブル登録
                $bankJapanNew = new BankJapan();
								$bankJapanNew::create([
										'bank_id'  => $lastId,
										'mark'     => $banks['yucho_mark'],
                ]);
            } else {
								dd('NO');
                // 銀行テーブル登録
                $bankNew->user_id = $userId;
                $bankNew->type    = 'other';
                $bankNew->number  = $banks['other_number'];
                $bankNew->name    = $banks['other_name'];
                $bankNew->save();
                $lastId = $bankNew->id;

                // その他テーブル登録
                $bankNewOther = new BankOther();
                $bankNewOther->bank_id        = $banks['other_number'];
                $bankNewOther->financial_name = $banks['other_number'];
                $bankNewOther->branch_name    = $banks['other_number'];
                $bankNewOther->branch_number  = $banks['other_number'];
                $bankNewOther->type           = $banks['other_number'];
						}
            DB::commit();
            return redirect(route('mypage.t.bank.show'));
        } catch(\Exception $e) {
            DB::rollBack();
            $error = '登録に失敗しました。再度、ご登録をお願いいたします。';
            return back()->withInput()->withErrors($error);
        }
        $error = '不明なエラーが発生しました。管理者へお問い合わせください。';
        return back()->withInput()->withErrors($error);
        // // バージョン1
        // /* パラーメーター設定 */
        // // バリデーションの値を取得する
        // $validated = $request->validated();
        // // ユーザーID
        // $user_id = Auth::id();

        // // dd(isset($validated['other_financial_name']));
        // /* トランザクションをしく */
        // // DBに登録
        // DB::transaction(function () use($validated, $request, $user_id) {
        //     // １．登録済みの銀行の情報を削除
        //     if(JapansBank::find(session('bank_id'))) {
        //         $register_bank = JapansBank::find(session('bank_id'));
        //         if($register_bank) {
        //             $register_bank->delete();
        //             $register_bank->save();
        //         }
        //     }
        //     if(OthersBank::find(session('bank_id'))) {
        //         // 登録済み情報を論理削除
        //         $register_bank = OthersBank::find(session('bank_id'));
        //         if($register_bank) {
        //             $register_bank->delete();
        //             $register_bank->save();
        //         }
        //     }

        //     // ２．銀行の登録
        //     if(isset($validated['yucho_mark'])) {
        //         $japan_bank = new JapansBank();
        //         $date = $japan_bank->registerJapanBank($request, $user_id);
        //     }
        //     // その他銀行の登録作業
        //     if(isset($validated['other_financial_name'])) {
        //         $other_bank = new OthersBank();
        //         $date = $other_bank->registerOtherBank($request, $user_id);
        //     };
        // });

        // // セッションをリセット
        // $request->session()->forget('bank_type');
        // $request->session()->forget('bank_id');

        // // 銀行の編集画面にリダイレクト処理
        // $url = '';
        // if(Auth::user()->status == 0) {
        //     $url = 'mypage.u.bank.show';
        // } else {
        //     $url = 'mypage.t.bank.show';
        // }
        // return redirect(route($url));
    }
}
