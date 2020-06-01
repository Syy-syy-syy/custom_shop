# ECサイト

## DB名
`custom_shop`
1. mysql上でcustom_shopのDBを作成してください。
2. laradock/mysql/docker-entrypoint-initdb.dフォルダへ以下のファイルをコピー。
`create_tables.sql`
3. mysqlへログイン
4. 以下のコマンドを実行
`source /docker-entrypoint-initdb.d/create_tables.sql`

## config配下
1. `db_settings.php.example`を複製して`db_settings.php`を作成。
2. `db_settings.php`のコメントアウトを外す

## 課題
githubのissueで管理します。

## ブランチ
ブランチ名は`feature/数字`にしてください。
数字はissue番号と紐づきます。

## コミット名
できるだけわかりやすい内容にしてください。

## プルリクエスト
タイトル・内容は具体的にわかりやすくしてください。
