<?php
ini_set('display_errors', 1);
// MySQLサーバ接続に必要な値を変数に代入
require_once('../../config/db_settings.php');

$db_val = db_config();
$user = $db_val['user'];
$pass = $db_val['password'];
$dsn = $db_val['dsn'];
$options = $db_val['options'];

if (isset($_POST['category'])) {
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        $sql = 'INSERT INTO categories (name) VALUES (:name)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->execute();

        header("Location: /category/index.php");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>

<form action="/category/create.php" method="POST">
    <label>カテゴリ登録</label>
    <input type="text" name="name" placeholder="カテゴリ名" required>
    <input type="submit" name="category" value="登録">
</form>
<a href="/category/index.php">カテゴリ一覧</a>