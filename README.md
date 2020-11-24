# おけい.com
## 前提
https://readouble.com/laravel/8.x/ja/installation.html サーバ要件　より抜粋

>Laravelフレームワークを動作させるには多少のシステム要件があります。Laravel Homestead仮想マシンでは、要求がすべて満たされています。そのため、Laravelのローカル開発環境としてHomesteadを活用されることを強く推奨します。
>しかし、Homesteadを使用しない場合は、以下の要件を満たす必要があります。

>PHP >= 7.3
>BCMath PHP拡張
>Ctype PHP拡張
>Fileinfo PHP拡張
>JSON PHP拡張
>Mbstring PHP拡張
>OpenSSL PHP拡張
>PDO PHP拡張
>Tokenizer PHP拡張
>XML PHP拡張

## 構築手順
* composerインストール<br>
composer install
* .env.exampleをコピーして.env作成<br>
cp .env.example .env
* .envのDB_XXXを環境に合わせて変更
* 開発用Webサーバ起動<br>
(ビルトインサーバを使う場合)php artisan serve
* 初回とpackage.json変更時のみ npmインストール<br>
npm install
* Vueのビルド<br>
npm run dev
* 開発時にJSの変更のたびにトランスパイルしたい場合<br>
npm run watch-poll
