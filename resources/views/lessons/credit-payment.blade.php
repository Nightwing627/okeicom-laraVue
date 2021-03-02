<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://linkpt.cardservice.co.jp/api/token/1.0/zeus_token_cvv.js"></script>
    <link rel="stylesheet" href="https://linkpt.cardservice.co.jp/api/token/1.0/zeus_token.css">
</head>
<body>

    {{--
    <form method="POST" name="form1" action="https://linkpt.cardservice.co.jp/cgi-bin/token/token.cgi">
        <input type="text" name="request.service" value="token">
        <input type="text" name="request.action" value="newcard">
        <input type="text" name="authentication.clientip" value="2014003669">
        <input type="text" name="card.number" value="5778689503669749">
        <input type="text" name="card.expires.year" value="2021">
        <input type="text" name="card.expires.month" value="03">
        <input type="text" name="card.name" value="KAN NAKAZAWA">
        <input type="text" name="card.cvv" value="000">
        <button type="submit">決済する</button>
    </form>
    --}}

    <form method="POST" name="form1" action="https://linkpt.cardservice.co.jp/cgi-bin/token/token.cgi">
        <input id="zeus_token_action_type_quick" type="text" name="request.service" value="token">
        <input id="zeus_token_action_type_new" type="text" name="request.action" value="newcard">
        <input type="text" name="authentication.clientip" value="2014003669">
        <input id="zeus_token_card_number" type="text" name="card.number" value="5778689503669749">
        <input id="zeus_token_card_expires_year" type="text" name="card.expires.year" value="2021">
        <input id="zeus_token_card_expires_month" type="text" name="card.expires.month" value="03">
        <input id="zeus_token_card_name" type="text" name="card.name" value="KAN NAKAZAWA">
        <input id="zeus_token_card_cvv" type="text" name="card.cvv" value="000">
        <button id="btn_go_to_confirm_page" type="submit">決済する</button>
    </form>

    {{--
    <form method="POST" name="form1" action="https://linkpt.cardservice.co.jp/cgi-bin/token/token.cgi/">
        @csrf
        <input type="text" name="request.service" value="token">
        <input type="text" name="request.action" value="newcard">
        <input type="text" name="authentication.clientip" value="2014003669">
        <input type="text" name="card.number" value="5778689503669749">
        <input type="text" name="card.expires.year" value="2021">
        <input type="text" name="card.expires.month" value="03">
        <input type="text" name="card.name" value="KAN NAKAZAWA">
        <input type="text" name="card.cvv" value="234">
        <button id="btn_go_to_confirm_page" type="submit">決済する</button>
    </form>
    --}}

    {{--
    <form method="POST" name="form1" action="https://linkpt.cardservice.co.jp/cgi-bin/token/token.cgi">
        @csrf
        <input id="zeus_token_action_type_quick" type="text" value="token">
        <input id="zeus_token_action_type_new" type="text" value="newcard">
        <input id="zeus_token_card_number" type="text" value="5778689503669749">
        <input id="zeus_token_card_expires_year" type="text" value="2021">
        <input id="zeus_token_card_expires_month" type="text" value="03">
        <input id="zeus_token_card_name" type="text" value="KAN NAKAZAWA">
        <input id="zeus_token_card_cvv" type="text" value="234">
        <button id="btn_go_to_confirm_page" type="submit">決済する</button>
    </form>
    --}}

    {{--
    <p id="zeus_token_action_type_quick"></p>
    <p id="zeus_token_action_type_new"></p>
    <p id="zeus_token_card_number"></p>
    <p id="zeus_token_card_expires_year"></p>
    <p id="zeus_token_card_expires_month"></p>
    <p id="zeus_token_card_name"></p>
    <p id="zeus_token_card_cvv"></p>
    --}}

    <script>
        var zeusTokenIpcode = "2014003669"; // ゼウス発行のIPCODE(10桁または5桁)
        function beforeSubmit() {
            zeusToken.getToken(function(zeus_token_response_data) {
                // ここにトークン発行後の処理を入れてください。
                if (!zeus_token_response_data['result']) {
                    alert(zeusToken.getErrorMessage(zeus_token_response_data['error_code'])); // エラーの場合
                } else {
                    document.form1.submit(); // フォーム送信（カード情報のかわりにトークンキーが送信されます）
                }
            });
        }
        window.onload = function() {
            document.getElementById('btn_go_to_confirm_page').onclick = function () {
                beforeSubmit(); // フォーム送信ボタンのonclickイベントで、上記関数を呼出します。
            }
        };
    </script>
</body>
</html>
