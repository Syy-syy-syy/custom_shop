<?php
ini_set('display_errors', 1);

require_once('../../config/db_settings.php');

$db_val = db_config();
$user = $db_val['user'];
$pass = $db_val['password'];
$dsn = $db_val['dsn'];
$options = $db_val['options'];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $sql = 'SELECT * FROM categories WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch();
    if (!$res) {
        header("Location: /category/index.php");
        exit();
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

if (isset($_POST['delete'])) {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $sql = 'DELETE FROM categories WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $database = null;
    header("Location: /category/index.php");
    exit();
}

?>

<h1>カテゴリ詳細ページ</h1>
<ul>
    <li><?php echo $res['name']; ?></li>
</ul>
<a href="/category/edit.php?id=<?php echo $_GET['id']; ?>">編集</a>
<form method="POST">
    <input type="submit" name="delete" value="削除">
</form>
<a href="/category/index.php">カテゴリ一覧</a>