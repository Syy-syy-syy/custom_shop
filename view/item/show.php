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
    $sql = 'SELECT * FROM items WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch();
    $pdo = null;
} catch (PDOException $e) {
    return $e->getMessage();
}

if (empty($res)) {
    header('Location: index.php');
}

if (isset($_POST['delete'])) {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $sql = 'DELETE FROM items WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $database = null;

    header('Location: index.php');
}
?>

<ul>
    <li>商品名: <?php echo $res['name']; ?></li>
    <li>商品説明: <?php echo $res['descript']; ?></li>
    <li>価格: <?php echo $res['price']; ?></li>
    <li>在庫数: <?php echo $res['stock']; ?></li>
</ul>
<form method="post">
    <input type="submit" name="delete" value="削除">
</form>
<a href="edit.php?id=<?php echo $_GET['id']; ?>">編集</a>
<button type="button" onclick="history.back()">戻る</button>