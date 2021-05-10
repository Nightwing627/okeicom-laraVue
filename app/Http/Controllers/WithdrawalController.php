<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class WithdrawalController extends Controller
{
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
}
