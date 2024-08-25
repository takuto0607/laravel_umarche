## MEMO

## ダウンロード方法

git clone

git clone https://github.com/takuto0607/laravel_umarche

git clone ブランチを指定してダウンロードする場合

git clone -b ブランチ名　https://github.com/takuto0607/laravel_umarche

もしくはzipファイルでダウンロードしてください


## インストール方法

- cd laravel_umarche

- composer install

- npm install

- npm run dev

.env.example をコピーして .env ファイルを作成

.envファイルの中の下記をご利用の環境に合わせて変更してください

- DB_CONNECTION=mysql

- DB_HOST=127.0.0.1

- DB_DATABASE=laravel_umarche

- DB_USERNAME=umarche

- DB_PASSWORD=password123

XAMPP/MAMPまたはほかの開発環境でDBを起動した後に

- php artisan migrate:fresh --seed

と実行してください

（データベーステーブルとダミーデータが追加されればOK）


最後に

- php artisan key:generate

と入力してキーを生成後、

- php artisan serve

で簡易サーバを立ち上げ、表示確認してください

## インストール後の実施事項

画像のダミーデータは
public/imagesフォルダ内に
sample1.jpg ~ sample6.jpg として保存

php artisan storage:link で
storageフォルダにリンク後、

storage/app/public/productsフォルダ内に
保存すると表示される
（productsフォルダがない場合は作成が必要）

ショップの画像も表示する場合は、
storage/app/public/shopsフォルダを作成し画像を保存

## section07の補足

決済のテストとしてstripeを利用しています。

必要な場合は .env に stripe の情報を追記してください。

（講座内で解説）

## section08の補足

メールのテストとしてmailtrapを利用しています。

必要な場合は .env に mailtrap の情報を追記してください。

（講座内で解説）

メール処理には時間がかかるため、キューを使用

必要な場合は、

- php artisan queue:work

でワーカーを立ち上げて動作確認するようにしてください。
