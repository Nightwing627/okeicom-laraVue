お問い合わせいただきありがとうございました。
お問い合わせを受け付けました。

折り返し、担当者よりご連絡いたしますので、
恐れ入りますが、しばらくお待ちください。

なお、ご入力いただいたメールアドレス宛に受付完了メールを配信しております。
完了メールが届かない場合、処理が正常に行われていない可能性があります。
大変お手数ですが、再度お問い合わせの手続きをお願い致します。


【お問い合わせ内容】

メールアドレス：{{ $content['email'] }}
お名前／表示名：{{ $content['name'] }}
区分：@if($content['class'] == 1) 生徒 @elseif($content['class'] == 2) 講師 @elseif($content['class'] == 3) その他 @endif

件名：@if($content['subject'] == 1) 会員登録について @elseif($content['subject'] == 2) 入金確認依頼 @elseif($content['subject'] == 3) 講師・レッスンについて @elseif($content['subject'] == 4) 領収書発行依頼 @elseif($content['subject'] == 5) 修了証発行依頼 @elseif($content['subject'] == 6) キャンペーンについて @elseif($content['subject'] == 7) おけいcomへのご要望 @elseif($content['subject'] == 8) 規約違反や著作権侵害を報告 @elseif($content['subject'] == 9) スタッフ募集について @elseif($content['subject'] == 10) 法人契約について @elseif($content['subject'] == 11) コラボ支援サービスについて @elseif($content['subject'] == 12) 退会したい @elseif($content['subject'] == 13) ベータテストについて @elseif($content['subject'] == 14) その他 @endif

画像：{{ $message->embed('storage/contact/' .$image) }}
内容：{{ $content['detail'] }}


おけいcom
info@okeicom.com
