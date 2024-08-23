## MEMO

## インストール方法

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